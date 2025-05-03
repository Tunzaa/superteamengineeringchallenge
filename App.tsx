import React, {JSX, useMemo, useState} from 'react';
import WelcomeScreen from './src/screens/WelcomeScreen';
import {Navigation} from './src/types/navigation';
import HomeScreen from './src/screens/HomeScreen';
import NotFoundScreen from './src/screens/NotFoundScreen';
import SuccessScreen from "./src/screens/SuccessScreen";

function App() {
  const [current, setCurrent] = useState<JSX.Element>();

  const navigation: Navigation = {
    goBack: () => {
      setCurrent(startScreen);
    },
    navigate: (path,data) => {
      switch (path) {
        case 'Home':
          setCurrent(homeScreen);
          return;
        case 'Success':
          setCurrent(successScreen(data));
          return;
        case 'Start':
          setCurrent(startScreen);
          return;
        default:
          setCurrent(notFoundScreen);
      }
    },
  };

  const startScreen = useMemo(
    () => <WelcomeScreen navigation={navigation} />,
    [],
  );
  const homeScreen = useMemo(() => <HomeScreen navigation={navigation} />, []);
  const successScreen = useMemo(() => {
    return (data: any) => <SuccessScreen navigation={navigation} route={{ params: data }} />;
  }, []);
  const notFoundScreen = useMemo(
    () => <NotFoundScreen navigation={navigation} />,
    [],
  );

  return current ?? startScreen;
}

export default App;
