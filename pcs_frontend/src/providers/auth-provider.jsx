import { createContext, useContext, useEffect, useMemo } from 'react';
import { useNavigate } from 'react-router-dom';
import { LocalStorageService } from '../services/local-storage-service';
import Sanctum from '../sanctum/sanctum'
import Cookies from 'js-cookie'

const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
  const [user, setUser] = LocalStorageService("user", null);
  const navigate = useNavigate();

  useEffect(() => {
    Sanctum.csrfCookie()
  }, [])

  const login = async (data) => {
    setUser(data);
    navigate('/home');
  }

  const logout = () => {
    setUser(null);
    navigate('/');
  }

  const value = useMemo(() => ({
    user,
    login,
    logout
  }),
  [user]);

  return <AuthContext.Provider value={value}>{children}</AuthContext.Provider>;
}

export const useAuth = () => {
  return useContext(AuthContext);
}