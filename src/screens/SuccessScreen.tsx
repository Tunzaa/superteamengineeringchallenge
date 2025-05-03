import React from 'react';
import {
  View,
  Text,
  StyleSheet,
  TouchableOpacity,
  SafeAreaView,
  StatusBar,
  Image,
} from 'react-native';
import { Navigation } from '../types/navigation';

type SuccessScreenProps = {
  navigation: Navigation;
  route: {
    params: {
      goalName: string;
    };
  };
};

const SuccessScreen = ({ navigation, route }: SuccessScreenProps) => {
  const { goalName } = route.params;


  return (
    <SafeAreaView style={styles.container}>
      <StatusBar barStyle="dark-content" backgroundColor="#FFFFFF" />

      <View style={styles.content}>
        <Text style={styles.title}>Success!</Text>
        <Text style={styles.subtitle}>You've reached {goalName??''} goal.</Text>

        <View style={styles.illustrationContainer}>
          <View style={styles.confetti}>
            {/* Confetti elements */}
            <View style={[styles.confettiPiece, { top: '10%', left: '20%', transform: [{ rotate: '15deg' }], backgroundColor: '#FFD263' }]} />
            <View style={[styles.confettiPiece, { top: '15%', right: '25%', transform: [{ rotate: '45deg' }], backgroundColor: '#FF6B6B' }]} />
            <View style={[styles.confettiPiece, { top: '30%', left: '15%', transform: [{ rotate: '30deg' }], backgroundColor: '#4ECDC4' }]} />
            <View style={[styles.confettiPiece, { bottom: '35%', right: '10%', transform: [{ rotate: '60deg' }], backgroundColor: '#7A77FF' }]} />
            <View style={[styles.confettiPiece, { bottom: '25%', left: '5%', transform: [{ rotate: '20deg' }], backgroundColor: '#FFD263' }]} />
            <View style={[styles.confettiPiece, { top: '5%', right: '15%', transform: [{ rotate: '10deg' }], backgroundColor: '#FF6B6B' }]} />
            <View style={[styles.confettiPiece, { bottom: '15%', right: '20%', transform: [{ rotate: '35deg' }], backgroundColor: '#4ECDC4' }]} />
          </View>

          <View style={styles.trophyCircle}>
            <Text style={styles.trophyIcon}>🏆</Text>
            {/*<View style={styles.personContainer}>*/}
            {/*  <View style={styles.personHead} />*/}
            {/*  <View style={styles.personBody} />*/}
            {/*</View>*/}
          </View>
        </View>
      </View>

      <TouchableOpacity style={styles.doneButton} onPress={event => {
        navigation.navigate('Home');
      }}>
        <Text style={styles.doneButtonText}>Done!</Text>
      </TouchableOpacity>

      <View style={styles.bottomIndicator} />
    </SafeAreaView>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#FFFFFF',
    justifyContent: 'space-between',
    alignItems: 'center',
    paddingVertical: 40,
  },
  content: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    width: '100%',
    paddingHorizontal: 20,
  },
  title: {
    fontSize: 32,
    fontWeight: 'bold',
    color: '#1A0F3C',
    marginBottom: 10,
  },
  subtitle: {
    fontSize: 18,
    color: '#666',
    marginBottom: 40,
    textAlign: 'center',
  },
  illustrationContainer: {
    width: 250,
    height: 250,
    marginVertical: 30,
    justifyContent: "center",
    alignItems: "center"
    // position: 'relative',
  },
  confetti: {
    position: 'absolute',
    width: '100%',
    height: '100%',
  },
  confettiPiece: {
    position: 'absolute',
    width: 15,
    height: 5,
    borderRadius: 2,
  },
  trophyCircle: {
    width: 150,
    height: 150,
    borderRadius: 100,
    backgroundColor: '#5D3FD3',
    justifyContent: 'center',
    alignItems: 'center',
    // position: 'absolute',
    // top: 25,
    // left: 25,
  },
  trophyIcon: {
    fontSize: 50,
    marginBottom: 20,
  },
  personContainer: {
    position: 'absolute',
    bottom: 30,
    alignItems: 'center',
  },
  personHead: {
    width: 30,
    height: 30,
    borderRadius: 15,
    backgroundColor: '#8D6E63',
    marginBottom: 5,
  },
  personBody: {
    width: 60,
    height: 60,
    borderRadius: 30,
    backgroundColor: '#FF7043',
  },
  doneButton: {
    width: '90%',
    height: 56,
    backgroundColor: '#1A0F3C',
    borderRadius: 10,
    justifyContent: 'center',
    alignItems: 'center',
    marginBottom: 20,
  },
  doneButtonText: {
    color: '#FFFFFF',
    fontSize: 18,
    fontWeight: 'bold',
  },
  bottomIndicator: {
    width: 40,
    height: 5,
    backgroundColor: '#000000',
    borderRadius: 3,
    opacity: 0.2,
  },
});

export default SuccessScreen;
