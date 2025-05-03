import {saveUser} from '../utils/userStorage';
import {Navigation} from '../types/navigation';

export async function handleGetStarted(navigation: Navigation): Promise<any> {
  const newUser = {
    id: Date.now().toString(),
    name: 'Tunza Super ⭐️',
    mobile: '+255 764 764 764',
    isNewUser: true,
    createdAt: new Date().toISOString(),
  };

  await saveUser(newUser);
  navigation.navigate('Home');
}
