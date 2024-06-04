import { useState, useEffect } from 'react'
import AuthApi from '../api/auth-api'
import MainMenuOption from '../components/main-menu-option'
import MainMenuOptions from '../components/main-menu-option/main-menu-option'
import { useAuth } from '../providers/auth-provider'
import { useNavigate } from 'react-router-dom';
import ProductApi from '../api/product-api'
import ProductList from '../components/product-list'
import CartApi from '../api/cart-api'

const HomePage = () => {
  const navigate = useNavigate()
  const authContext = useAuth()
  const [ products, setProducts ] = useState([])
  const [ currentPage, setCurrentPage ] = useState(1)

  useEffect(() => {
    ProductApi.index({ currentPage })
              .then((response) => {
                setProducts(response.data.data)
                setCurrentPage(response.data.current_page)
              })
  }, [])

  const handleClickLogout = () => {
    AuthApi.logout()
           .then((response) => {
            authContext.logout()
           })
  }

  const addToCart = async (productId, quantity) => {
    try {
      const response = await CartApi.addToCart({ product_id: productId, quantity });
      if (response.status === 200) {
        // Assuming the API returns the updated cart items
        alert('added to cart!')
      } else {
        throw new Error('Failed to add product to cart');
      }
    } catch (error) {
      console.error('Error adding product to cart:', error);
      // Handle the error, e.g., show a notification to the user
    }
  }

  console.log(products)

  return(
    <div>
      <ProductList products={products} current_page={currentPage} onAddToCart={ addToCart } />
      <MainMenuOption
        label={ 'Logout' }
        onClick={ handleClickLogout}
      />
    </div>
  )
}

export default HomePage