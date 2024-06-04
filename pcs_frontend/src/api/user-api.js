import axios from 'axios'

const UserApi = {
  register: async (email, name, password, password_confirmation) => {
    // We set the baseUrl in /configs/axios-config.js already
    // Just specify path here
    const path     = `/api/users`
    const body     = {
      email                 : email,
      name                  : name,
      password              : password,
      password_confirmation : password_confirmation
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

export default UserApi