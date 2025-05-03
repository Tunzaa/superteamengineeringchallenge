type CacheType = {tunzaa_user?: any};
const _cache: CacheType = {};

export async function saveUser(userData: object) {
  try {
    _cache.tunzaa_user = userData;
    return true;
  } catch (error) {
    console.error('Error saving user data:', error);
    return false;
  }
}

export async function getUser(): Promise<object | null> {
  try {
    const userData = _cache.tunzaa_user;
    return userData || null;
  } catch (error) {
    console.error('Error retrieving user data:', error);
    return null;
  }
}

export const userExists = async () => {
  const user = await getUser();
  return user !== null;
};

export async function clearUser(){
  try {
    delete _cache.tunzaa_user;
    return true;
  } catch (error) {
    console.error('Error clearing user data:', error);
    return false;
  }
}
