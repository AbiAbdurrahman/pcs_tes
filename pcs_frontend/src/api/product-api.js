import axios from 'axios'

const path = '/api/products'

const ProductApi = {
  index: async ({page = 1}) => {
    // We set the baseUrl in /configs/axios-config.js already
    // Just specify path here
    const response = axios.get(`${path}?page=${page}`)
    return response
  }
}

export default ProductApi