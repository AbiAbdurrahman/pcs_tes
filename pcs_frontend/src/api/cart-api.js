import axios from 'axios'

const path = '/api/carts'

const CartApi = {
  addToCart: async ({ product_id, quantity }) => {
    const body = {
      "product_id" : product_id,
      "quantity" : quantity
    }

    const response = axios.patch(`${path}/add`, body)
    return response
  }
}

export default CartApi