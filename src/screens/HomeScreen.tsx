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
} from 'react-native';
import {clearUser} from '../utils/userStorage';
import {Navigation} from '../types/navigation';
import {Colors} from 'react-native/Libraries/NewAppScreen';
import { SavingsMeter } from "../components/SavingsMeter";

const HomeScreen = ({navigation}: {navigation: Navigation}) => {
  const isDarkMode = useColorScheme() === 'dark';
  const animatedValue = useRef(new Animated.Value(0)).current;
  const [displayValue, setDisplayValue] = useState('0');

  const savingsData = {
    totalSavings: 121840,
    categories: [
      {id: 1, name: 'Christmas', selected: true},
      {id: 2, name: 'Holiday', selected: false},
      {id: 3, name: 'House', selected: false},
      {id: 4, name: 'Future', selected: false},
    ],
    currentGoal: {
      name: 'Christmas',
      saved: 245,
      total: 600,
    },
  };

  useEffect(() => {
    Animated.timing(animatedValue, {
      toValue: savingsData.totalSavings,
      duration: 700,
      easing: Easing.out(Easing.ease),
      useNativeDriver: false,
    }).start();

    const listener = animatedValue.addListener(({value}) => {
      setDisplayValue(value.toFixed(2));
    });

    return () => {
      animatedValue.removeListener(listener);
    };
  }, []);

  const handleAddMoney = () => {
    // This would navigate to an Add Money screen in a complete app
  };

  const handleNewGoal = () => {
    // This would navigate to a New Goal screen in a complete app
  };

  const handleViewAllGoals = () => {
    // This would navigate to a Goals List screen in a complete app
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
        {/*<View style={styles.header}>*/}
        {/*  <TouchableOpacity style={styles.notificationIcon}>*/}
        {/*    <Text style={styles.notificationText}>🔔</Text>*/}
        {/*  </TouchableOpacity>*/}
        {/*</View>*/}

        <View style={styles.totalSavingsContainer}>
          <Text style={styles.totalSavingsLabel}>Total savings</Text>
          <Text style={styles.totalSavingsAmount}>TZS {displayValue}</Text>
        </View>

        <ScrollView
          horizontal
          showsHorizontalScrollIndicator={false}
          style={styles.categoriesContainer}>
          {savingsData.categories.map(category => (
            <TouchableOpacity
              key={category.id}
              style={[
                styles.categoryButton,
                category.selected && styles.selectedCategory,
              ]}>
              <Text
                style={[
                  styles.categoryText,
                  category.selected && styles.selectedCategoryText,
                ]}>
                {category.name}
              </Text>
            </TouchableOpacity>
          ))}
        </ScrollView>

          <View style={styles.progressCircleContainer}>
            <SavingsMeter value={savingsData.currentGoal.saved} goal={savingsData.currentGoal.total}/>
          </View>

        <View style={styles.actionsContainer}>
          <TouchableOpacity
            style={styles.actionButton}
            onPress={handleAddMoney}>
            <View style={styles.actionIconContainer}>
              <Text style={styles.actionIcon}>💰</Text>
            </View>
            <Text style={styles.actionText}>Add money</Text>
            <Text style={styles.actionArrow}>›</Text>
          </TouchableOpacity>

          <TouchableOpacity style={styles.actionButton} onPress={handleNewGoal}>
            <View style={styles.actionIconContainer}>
              <Text style={styles.actionIcon}>🐷</Text>
            </View>
            <Text style={styles.actionText}>New goal</Text>
            <Text style={styles.actionArrow}>›</Text>
          </TouchableOpacity>

          <TouchableOpacity
            style={styles.actionButton}
            onPress={handleViewAllGoals}>
            <View style={styles.actionIconContainer}>
              <Text style={styles.actionIcon}>📊</Text>
            </View>
            <Text style={styles.actionText}>View all goals</Text>
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
      </ScrollView>
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
    // width: 200,
    // minHeight: 140,
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
  actionIconContainer: {
    width: 40,
    height: 40,
    borderRadius: 20,
    backgroundColor: '#F5F7FA',
    justifyContent: 'center',
    alignItems: 'center',
    marginRight: 16,
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
});

export default HomeScreen;
