import React, {useEffect, useMemo, useRef, useState} from 'react';
import {
  View,
  Text,
  StyleSheet,
  TouchableOpacity,
  ScrollView,
  Animated,
  Easing,
  StatusBar,
  SafeAreaView,
  useColorScheme,
  Modal,
  TextInput,
  Alert,
} from 'react-native';
import {clearUser} from '../utils/userStorage';
import {Navigation} from '../types/navigation';
import {Colors} from 'react-native/Libraries/NewAppScreen';
import { SavingsMeter } from "../components/SavingsMeter";
import { formatCurrency } from "../utils/helper";


const HomeScreen = ({navigation}: {navigation: Navigation}) => {
  const isDarkMode = useColorScheme() === 'dark';
  const animatedValue = useRef(new Animated.Value(0)).current;
  const [displayValue, setDisplayValue] = useState('0');
  const [selectedCategoryId, setSelectedCategoryId] = useState(1);
  const [modalVisible, setModalVisible] = useState(false);
  const [amountToAdd, setAmountToAdd] = useState('');
  const [newGoalModalVisible, setNewGoalModalVisible] = useState(false);
  const [newGoalName, setNewGoalName] = useState('');
  const [newGoalAmount, setNewGoalAmount] = useState('');

  const [savingsData, setSavingsData] = useState<any>({
    totalSavings: 0,
    categories: [],
    goals: {}
  });

  const currentGoal:any = savingsData.goals[selectedCategoryId];

  const isGoalReached = currentGoal && currentGoal.saved >= currentGoal.total;

  const handleCategorySelect = (categoryId: React.SetStateAction<number>) => {
    setSelectedCategoryId(categoryId);
  };

  const animateTotalSavings = (newTotal: number) => {
    animatedValue.setValue(parseFloat(displayValue.replace(/,/g, '')));
    Animated.timing(animatedValue, {
      toValue: newTotal,
      duration: 700,
      easing: Easing.out(Easing.ease),
      useNativeDriver: false,
    }).start();
  };

  useEffect(() => {
    animateTotalSavings(savingsData.totalSavings);
    const listener = animatedValue.addListener(({value}) => {
      setDisplayValue(formatCurrency(value));
    });
    return () => {
      animatedValue.removeListener(listener);
    };
  }, []);

  const handleAddMoney = () => {
    setModalVisible(true);
  };

  const handleAddMoneySubmit = () => {
    const amount = parseFloat(amountToAdd);

    if (isNaN(amount) || amount <= 0) {
      Alert.alert('Invalid Amount', 'Please enter a valid amount greater than 0');
      return;
    }

    const newTotalSavings = savingsData.totalSavings + amount;

    const updatedGoals:any = {...savingsData.goals};
    const goalKey = selectedCategoryId as keyof typeof updatedGoals;

    updatedGoals[goalKey] = {
      ...updatedGoals[goalKey],
      saved: updatedGoals[goalKey].saved + amount
    };

    setSavingsData({
      ...savingsData,
      totalSavings: newTotalSavings,
      goals: updatedGoals
    });


    animateTotalSavings(newTotalSavings);

    setModalVisible(false);
    setAmountToAdd('');
  };

  const handleArchiveGoal = () => {

    navigation.navigate('Success', { goalName: currentGoal.name });

    const updatedCategories:any[] = savingsData.categories.filter(
      (category:any) => category.id !== selectedCategoryId
    );


    if (updatedCategories.length === 0) {
      Alert.alert('No Goals Left', 'You have archived all your goals. Please create a new one.');
      return;
    }

    const updatedGoals = {...savingsData.goals};
    delete updatedGoals[selectedCategoryId as keyof typeof updatedGoals];

    const newSelectedId = updatedCategories[0].id;

    setSavingsData({
      ...savingsData,
      categories: updatedCategories,
      goals: updatedGoals
    });
    setSelectedCategoryId(newSelectedId);
  };

  const handleNewGoal = () => {
    setNewGoalModalVisible(true);
  };

  const handleNewGoalSubmit = () => {

    if (!newGoalName.trim()) {
      Alert.alert('Invalid Name', 'Please enter a goal name');
      return;
    }

    const amount = parseFloat(newGoalAmount);
    if (isNaN(amount) || amount <= 0) {
      Alert.alert('Invalid Amount', 'Please enter a valid amount greater than 0');
      return;
    }

    const newId = savingsData.categories.length > 0 
      ? Math.max(...savingsData.categories.map((cat:any) => cat.id)) + 1 
      : 1;

    const updatedCategories = [
      ...savingsData.categories,
      { id: newId, name: newGoalName, selected: false }
    ];

    const updatedGoals = {
      ...savingsData.goals,
      [newId]: {
        name: newGoalName,
        saved: 0,
        total: amount
      }
    };

    setSavingsData({
      ...savingsData,
      categories: updatedCategories,
      goals: updatedGoals
    });

    // Automatically select the newly created goal if it's the only one
    setSelectedCategoryId(newId);

    setNewGoalModalVisible(false);
    setNewGoalName('');
    setNewGoalAmount('');
  };

  const handleLogout = async () => {
    await clearUser();
    navigation.navigate('Start');
  };

  const backgroundStyle = useMemo(
    () => ({
      backgroundColor: isDarkMode ? Colors.darker : Colors.lighter,
    }),
    [isDarkMode],
  );

  return (
    <SafeAreaView style={styles.container}>
      <StatusBar
        barStyle={isDarkMode ? 'light-content' : 'dark-content'}
        backgroundColor={backgroundStyle.backgroundColor}
      />
      <ScrollView style={styles.container}>

        {savingsData.categories.length > 0 && (
          <View style={styles.totalSavingsContainer}>
            <Text style={styles.totalSavingsLabel}>Total savings</Text>
            <Text style={styles.totalSavingsAmount}>TZS {displayValue}</Text>
          </View>
        )}

        <ScrollView
          horizontal
          showsHorizontalScrollIndicator={false}
          style={styles.categoriesContainer}>
          {savingsData.categories.length > 0 && (
            savingsData.categories.map((category:any) => (
              <TouchableOpacity
                key={category.id}
                style={[
                  styles.categoryButton,
                  selectedCategoryId === category.id && styles.selectedCategory,
                ]}
                onPress={() => handleCategorySelect(category.id)}>
                <Text
                  style={[
                    styles.categoryText,
                    selectedCategoryId === category.id && styles.selectedCategoryText,
                  ]}>
                  {category.name}
                </Text>
              </TouchableOpacity>
            ))
          )}
        </ScrollView>

          {currentGoal ? (
            <View style={styles.progressCircleContainer}>
              <SavingsMeter
                value={currentGoal.saved}
                goal={currentGoal.total}
              />
            </View>
          ) : (
            <View style={styles.emptyStateContainer}>
              <View style={styles.emptyStateIconContainer}>
                <Text style={styles.emptyStateIcon}>💰</Text>
              </View>
              <Text style={styles.emptyStateTitle}>Nothing to show yet</Text>
              <Text style={styles.emptyStateSubtitle}>Create a goal to start saving!</Text>
              <TouchableOpacity style={styles.emptyStateActionButton} onPress={handleNewGoal}>
                <View style={styles.emptyStateActionIconContainer}>
                  <Text style={styles.emptyStateActionIcon}>➕</Text>
                </View>
                <Text style={styles.emptyStateActionText}>Create Goal</Text>
                <Text style={styles.actionArrow}>›</Text>
              </TouchableOpacity>
              
              <View style={styles.insightCardsContainer}>
                <View style={styles.insightCard}>
                  <View style={[styles.insightIconContainer, {backgroundColor: '#FFF0E6'}]}>
                    <Text style={styles.insightIcon}>💡</Text>
                  </View>
                  <Text style={styles.insightTitle}>Smart Goal Setting</Text>
                  <Text style={styles.insightText}>Set specific, measurable goals with realistic timeframes for better success.</Text>
                </View>
                
                <View style={styles.insightCard}>
                  <View style={[styles.insightIconContainer, {backgroundColor: '#E6F7FF'}]}>
                    <Text style={styles.insightIcon}>🔍</Text>
                  </View>
                  <Text style={styles.insightTitle}>Track Progress</Text>
                  <Text style={styles.insightText}>Regular tracking helps you stay motivated and adjust your savings plan.</Text>
                </View>
                
                <View style={styles.insightCard}>
                  <View style={[styles.insightIconContainer, {backgroundColor: '#F0E6FF'}]}>
                    <Text style={styles.insightIcon}>🎯</Text>
                  </View>
                  <Text style={styles.insightTitle}>Celebrate Milestones</Text>
                  <Text style={styles.insightText}>Acknowledge your progress at key points to maintain motivation.</Text>
                </View>
              </View>
            </View>
          )}

          {currentGoal && (
            <View style={styles.actionsContainer}>
              {isGoalReached ? (
                <TouchableOpacity
                  style={[styles.actionButton, styles.archiveButton]}
                  onPress={handleArchiveGoal}>
                  <View style={[styles.actionIconContainer, styles.archiveIconContainer]}>
                    <Text style={styles.actionIcon}>🏆</Text>
                  </View>
                  <Text style={styles.actionText}>Archive Goal</Text>
                  <Text style={styles.actionArrow}>›</Text>
                </TouchableOpacity>
              ) : (
                <TouchableOpacity
                  style={styles.actionButton}
                  onPress={handleAddMoney}>
                  <View style={styles.actionIconContainer}>
                    <Text style={styles.actionIcon}>💰</Text>
                  </View>
                  <Text style={styles.actionText}>Add money</Text>
                  <Text style={styles.actionArrow}>›</Text>
                </TouchableOpacity>
              )}

              <TouchableOpacity style={styles.actionButton} onPress={handleNewGoal}>
                <View style={styles.actionIconContainer}>
                  <Text style={styles.actionIcon}>🐷</Text>
                </View>
                <Text style={styles.actionText}>New goal</Text>
                <Text style={styles.actionArrow}>›</Text>
              </TouchableOpacity>

              <TouchableOpacity style={styles.actionButton} onPress={handleLogout}>
                <View style={styles.actionIconContainer}>
                  <Text style={styles.actionIcon}>🔒</Text>
                </View>
                <Text style={styles.actionText}>Sign out</Text>
                <Text style={styles.actionArrow}>›</Text>
              </TouchableOpacity>
            </View>
          )}
      </ScrollView>

      {/* Add Money Modal */}
      <Modal
        animationType="slide"
        transparent={true}
        visible={modalVisible}
        onRequestClose={() => setModalVisible(false)}
      >
        <View style={styles.modalOverlay}>
          <View style={styles.modalContent}>
            <Text style={styles.modalTitle}>Add Money to {currentGoal?.name}</Text>

            <TextInput
              style={styles.amountInput}
              placeholder="Enter amount"
              keyboardType="numeric"
              value={amountToAdd}
              onChangeText={setAmountToAdd}
            />

            <View style={styles.modalButtons}>
              <TouchableOpacity
                style={[styles.modalButton, styles.cancelButton]}
                onPress={() => {
                  setModalVisible(false);
                  setAmountToAdd('');
                }}
              >
                <Text style={styles.cancelButtonText}>Cancel</Text>
              </TouchableOpacity>

              <TouchableOpacity
                style={[styles.modalButton, styles.addButton]}
                onPress={handleAddMoneySubmit}
              >
                <Text style={styles.addButtonText}>Add</Text>
              </TouchableOpacity>
            </View>
          </View>
        </View>
      </Modal>

      {/* Add New Goal Modal */}
      <Modal
        animationType="slide"
        transparent={true}
        visible={newGoalModalVisible}
        onRequestClose={() => setNewGoalModalVisible(false)}
      >
        <View style={styles.modalOverlay}>
          <View style={styles.modalContent}>
            <Text style={styles.modalTitle}>Create New Savings Goal</Text>

            <TextInput
              style={styles.amountInput}
              placeholder="Goal Name"
              value={newGoalName}
              onChangeText={setNewGoalName}
            />

            <TextInput
              style={styles.amountInput}
              placeholder="Target Amount"
              keyboardType="numeric"
              value={newGoalAmount}
              onChangeText={setNewGoalAmount}
            />

            <View style={styles.modalButtons}>
              <TouchableOpacity
                style={[styles.modalButton, styles.cancelButton]}
                onPress={() => {
                  setNewGoalModalVisible(false);
                  setNewGoalName('');
                  setNewGoalAmount('');
                }}
              >
                <Text style={styles.cancelButtonText}>Cancel</Text>
              </TouchableOpacity>

              <TouchableOpacity
                style={[styles.modalButton, styles.addButton]}
                onPress={handleNewGoalSubmit}
              >
                <Text style={styles.addButtonText}>Create</Text>
              </TouchableOpacity>
            </View>
          </View>
        </View>
      </Modal>
    </SafeAreaView>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#F5F7FA',
  },
  header: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    padding: 20,
    paddingTop: 60,
  },
  profileContainer: {
    width: 50,
    height: 50,
    borderRadius: 25,
    backgroundColor: '#1A0F3C',
    overflow: 'hidden',
    justifyContent: 'center',
    alignItems: 'center',
  },
  profileImage: {
    width: 40,
    height: 40,
    borderRadius: 20,
  },
  notificationIcon: {
    width: 40,
    height: 40,
    justifyContent: 'center',
    alignItems: 'center',
  },
  notificationText: {
    fontSize: 24,
  },
  totalSavingsContainer: {
    marginTop: 48,
    alignItems: 'center',
    marginVertical: 20,
  },
  totalSavingsLabel: {
    fontSize: 16,
    color: '#666',
    marginBottom: 8,
  },
  totalSavingsAmount: {
    fontSize: 40,
    fontWeight: 'bold',
    color: '#1A0F3C',
  },
  categoriesContainer: {
    paddingHorizontal: 16,
    marginBottom: 20,
  },
  categoryButton: {
    paddingHorizontal: 20,
    paddingVertical: 10,
    borderRadius: 20,
    marginRight: 10,
    backgroundColor: '#F0F0F0',
  },
  selectedCategory: {
    backgroundColor: '#1A0F3C',
  },
  categoryText: {
    color: '#666',
  },
  selectedCategoryText: {
    color: '#FFFFFF',
  },
  goalContainer: {
    alignItems: 'center',
    marginBottom: 30,
  },
  progressCircleContainer: {
    marginBottom: 16,
    marginTop: 16,
  },
  progressBackground: {
    width: 200,
    height: 100,
    borderTopLeftRadius: 100,
    borderTopRightRadius: 100,
    position: 'absolute',
    backgroundColor: '#F0F0F0',
  },
  progressRightHalf: {
  },
  progressLeftHalf: {
  },
  progressFill: {
    height: 100,
    backgroundColor: '#FFCC33',
    borderTopLeftRadius: 100,
    borderTopRightRadius: 100,
  },
  progressContent: {
  },
  progressAmount: {
    fontSize: 32,
    fontWeight: 'bold',
    color: '#1A0F3C',
  },
  progressPercentage: {
    fontSize: 18,
    fontWeight: 'bold',
    color: '#1A0F3C',
  },
  goalText: {
    fontSize: 16,
    color: '#666',
  },
  actionsContainer: {
    paddingHorizontal: 16,
    marginBottom: 80,
  },
  actionButton: {
    flexDirection: 'row',
    alignItems: 'center',
    backgroundColor: '#FFFFFF',
    borderRadius: 12,
    padding: 16,
    marginBottom: 12,
    shadowColor: '#000',
    shadowOffset: {width: 0, height: 1},
    shadowOpacity: 0.05,
    shadowRadius: 2,
    elevation: 1,
  },
  archiveButton: {
    backgroundColor: '#F9F5FF',
    borderWidth: 1,
    borderColor: '#5D3FD3',
  },
  actionIconContainer: {
    width: 40,
    height: 40,
    borderRadius: 20,
    backgroundColor: '#F5F7FA',
    justifyContent: 'center',
    alignItems: 'center',
    marginRight: 16,
  },
  archiveIconContainer: {
    backgroundColor: '#EFE8FF',
  },
  actionIcon: {
    fontSize: 20,
  },
  actionText: {
    flex: 1,
    fontSize: 16,
    fontWeight: '500',
    color: '#1A0F3C',
  },
  actionArrow: {
    fontSize: 24,
    color: '#666',
  },
  tabBar: {
    flexDirection: 'row',
    justifyContent: 'space-around',
    alignItems: 'center',
    backgroundColor: '#FFFFFF',
    height: 60,
    position: 'absolute',
    bottom: 0,
    left: 0,
    right: 0,
    borderTopWidth: 1,
    borderTopColor: '#F0F0F0',
  },
  tabItem: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  mainTabItem: {
    width: 60,
    height: 60,
    backgroundColor: '#5D3FD3',
    borderRadius: 30,
    marginTop: -20,
    justifyContent: 'center',
    alignItems: 'center',
  },
  tabIcon: {
    fontSize: 20,
    color: '#666',
  },
  mainTabIcon: {
    fontSize: 20,
    color: '#FFFFFF',
  },
  // Modal styles
  modalOverlay: {
    flex: 1,
    backgroundColor: 'rgba(0, 0, 0, 0.5)',
    justifyContent: 'center',
    alignItems: 'center',
  },
  modalContent: {
    width: '80%',
    backgroundColor: 'white',
    borderRadius: 20,
    padding: 20,
    alignItems: 'center',
    shadowColor: '#000',
    shadowOffset: {
      width: 0,
      height: 2,
    },
    shadowOpacity: 0.25,
    shadowRadius: 4,
    elevation: 5,
  },
  modalTitle: {
    fontSize: 20,
    fontWeight: 'bold',
    color: '#1A0F3C',
    marginBottom: 20,
  },
  amountInput: {
    width: '100%',
    height: 50,
    borderWidth: 1,
    borderColor: '#E0E0E0',
    borderRadius: 10,
    paddingHorizontal: 15,
    fontSize: 16,
    marginBottom: 20,
  },
  modalButtons: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    width: '100%',
  },
  modalButton: {
    width: '48%',
    height: 50,
    borderRadius: 10,
    justifyContent: 'center',
    alignItems: 'center',
  },
  cancelButton: {
    backgroundColor: '#F0F0F0',
  },
  addButton: {
    backgroundColor: '#1A0F3C',
  },
  cancelButtonText: {
    color: '#666',
    fontSize: 16,
    fontWeight: '500',
  },
  addButtonText: {
    color: '#FFFFFF',
    fontSize: 16,
    fontWeight: '500',
  },
  emptyStateContainer: {
    alignItems: 'center',
    justifyContent: 'center',
    paddingVertical: 24,
    paddingHorizontal: 24,
    width: '100%',
  },
  emptyStateIconContainer: {
    width: 80,
    height: 80,
    borderRadius: 40,
    backgroundColor: '#F5F7FA',
    justifyContent: 'center',
    alignItems: 'center',
    marginBottom: 16,
    borderWidth: 1,
    borderColor: '#E0E0E0',
  },
  emptyStateIcon: {
    fontSize: 36,
  },
  emptyStateTitle: {
    fontSize: 20,
    fontWeight: 'bold',
    color: '#1A0F3C',
    marginBottom: 8,
    textAlign: 'center',
  },
  emptyStateSubtitle: {
    fontSize: 16,
    color: '#666',
    textAlign: 'center',
    marginBottom: 24,
    paddingHorizontal: 20,
  },
  emptyStateActionButton: {
    flexDirection: 'row',
    alignItems: 'center',
    backgroundColor: '#FFFFFF',
    borderRadius: 12,
    padding: 16,
    marginBottom: 12,
    shadowColor: '#000',
    shadowOffset: {width: 0, height: 1},
    shadowOpacity: 0.05,
    shadowRadius: 2,
    elevation: 1,
  },
  emptyStateActionIconContainer: {
    width: 40,
    height: 40,
    borderRadius: 20,
    backgroundColor: '#F5F7FA',
    justifyContent: 'center',
    alignItems: 'center',
    marginRight: 16,
  },
  emptyStateActionIcon: {
    fontSize: 20,
  },
  emptyStateActionText: {
    flex: 1,
    fontSize: 16,
    fontWeight: '500',
    color: '#1A0F3C',
  },
  createGoalButton: {
    backgroundColor: '#5D3FD3',
    paddingVertical: 12,
    paddingHorizontal: 24,
    borderRadius: 8,
    alignItems: 'center',
    justifyContent: 'center',
    shadowColor: '#000',
    shadowOffset: {width: 0, height: 2},
    shadowOpacity: 0.1,
    shadowRadius: 4,
    elevation: 2,
  },
  createGoalButtonText: {
    color: '#FFFFFF',
    fontSize: 16,
    fontWeight: 'bold',
  },
  insightCardsContainer: {
    marginTop: 30,
    width: '100%',
  },
  insightCard: {
    backgroundColor: '#FFFFFF',
    borderRadius: 12,
    padding: 16,
    marginBottom: 12,
    shadowColor: '#000',
    shadowOffset: {width: 0, height: 1},
    shadowOpacity: 0.05,
    shadowRadius: 2,
    elevation: 1,
  },
  insightIconContainer: {
    width: 40,
    height: 40,
    borderRadius: 20,
    justifyContent: 'center',
    alignItems: 'center',
    marginBottom: 12,
  },
  insightIcon: {
    fontSize: 20,
  },
  insightTitle: {
    fontSize: 16,
    fontWeight: 'bold',
    color: '#1A0F3C',
    marginBottom: 8,
  },
  insightText: {
    fontSize: 14,
    color: '#666',
    lineHeight: 20,
  },
});

export default HomeScreen;
