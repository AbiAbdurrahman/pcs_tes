import axios from 'axios'
import Cookies from 'js-cookie'
import { useAuth } from '../providers/auth-provider'
const AuthApi = {
  login: async (email, password) => {
    // We set the baseUrl in /configs/axios-config.js already
    // Just specify path here
    const path     = `/api/login`
    const body     = {
      email    : email,
      password : password
    }
    const response = axios.post(path, body)
    return response
  },

  logout: async () => {
    const path     = `/api/logout`
    const response = axios.post(path)
    return response
  }

}

export default AuthApi