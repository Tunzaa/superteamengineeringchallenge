import React, {useMemo, useEffect, useRef} from 'react';
import {
  Image,
  SafeAreaView,
  StatusBar,
  StyleSheet,
  Text,
  TouchableOpacity,
  useColorScheme,
  View,
  Animated,
} from 'react-native';
import {Colors} from 'react-native/Libraries/NewAppScreen';
import {handleGetStarted} from '../services/authentication';

// @ts-ignore
const WelcomeScreen = ({navigation}) => {
  const isDarkMode = useColorScheme() === 'dark';
  const pulseAnim = useRef(new Animated.Value(1)).current;

  useEffect(() => {
    Animated.loop(
      Animated.sequence([
        Animated.timing(pulseAnim, {
          toValue: 1.1,
          duration: 1000,
          useNativeDriver: true,
        }),
        Animated.timing(pulseAnim, {
          toValue: 1,
          duration: 1000,
          useNativeDriver: true,
        }),
      ]),
    ).start();
  }, [pulseAnim]);

  const handleSignIn = () => {
    navigation.navigate();
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
      <View style={styles.content}>
        <Animated.View
          style={[
            styles.imageContainer,
            {
              transform: [{scale: pulseAnim}],
            },
          ]}>
          <Image
            source={require('../assets/saving.png')}
            style={styles.image}
            onError={(e: any) => {
              e.target.onerror = null;
              e.target.style = styles.imageFallback;
            }}
          />
        </Animated.View>

        <Text style={styles.title}>Plan wisely!</Text>
        <Text style={styles.subtitle}>
          Manage your goals on the go with a little help from Tunzaa saving
          wallet.
        </Text>

        <TouchableOpacity
          style={styles.button}
          onPress={() => handleGetStarted(navigation)}>
          <Text style={styles.buttonText}>Get started!</Text>
        </TouchableOpacity>

        <View style={styles.signInContainer}>
          <Text style={styles.signInText}>Already have an account? </Text>
          <TouchableOpacity onPress={handleSignIn}>
            <Text style={styles.signInLink}>Sign in</Text>
          </TouchableOpacity>
        </View>
      </View>
    </SafeAreaView>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#FFFFFF',
  },
  content: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
    paddingHorizontal: 24,
  },
  imageContainer: {
    width: 240,
    height: 240,
    borderRadius: 120,
    overflow: 'hidden',
    marginBottom: 40,
    backgroundColor: '#5D3FD3',
  },
  image: {
    width: '100%',
    height: '100%',
    resizeMode: 'cover',
  },
  imageFallback: {
    backgroundColor: '#5D3FD3',
  },
  title: {
    fontSize: 32,
    fontWeight: 'bold',
    color: '#1A0F3C',
    marginBottom: 12,
    textAlign: 'center',
  },
  subtitle: {
    fontSize: 16,
    color: '#666',
    textAlign: 'center',
    marginBottom: 48,
    lineHeight: 24,
  },
  button: {
    backgroundColor: '#1A0F3C',
    paddingVertical: 16,
    paddingHorizontal: 24,
    borderRadius: 8,
    width: '100%',
    alignItems: 'center',
    marginBottom: 24,
  },
  buttonText: {
    color: '#FFFFFF',
    fontSize: 16,
    fontWeight: 'bold',
  },
  signInContainer: {
    flexDirection: 'row',
    alignItems: 'center',
  },
  signInText: {
    color: '#666',
    fontSize: 14,
  },
  signInLink: {
    color: '#1A0F3C',
    fontSize: 14,
    fontWeight: 'bold',
  },
});

export default WelcomeScreen;
