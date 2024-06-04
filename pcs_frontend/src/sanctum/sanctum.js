import axios from 'axios'
import Cookies from 'js-cookie'

const Sanctum = {
  csrfCookie: async () => {
    const path = '/sanctum/csrf-cookie'
    axios.get(path, { credentials: 'include' })
  }
}

export default Sanctum