import axios from 'axios'
import Cookies from 'js-cookie'

// Axios Defaults
axios.defaults.headers.common['Content-Type'] = 'application/json'

// XSRF Credentials
axios.defaults.xsrfCookieName  = 'XSRF-TOKEN'
axios.defaults.xsrfHeaderName  = 'X-XSRF-Token'
axios.defaults.withCredentials = true

// API Base URL
axios.defaults.baseURL = process.env.REACT_APP_API_BASE_URL

// axios.interceptors.response.use((response) => {
//   console.log('Response:', response)
//   console.log(response.headers['set-cookie'])
//   return response
// })

axios.interceptors.request.use((config) => {
  const user = window.localStorage.getItem('user')
  const userJSON = JSON.parse(user)
  if (userJSON != null) {
    config.headers['Authorization'] = `${userJSON.token_type} ${userJSON.token}`;
  }

  return config;
})