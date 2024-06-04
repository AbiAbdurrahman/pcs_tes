import { useEffect, useState } from 'react'
import ProductCard from '../product-card'

const ProductList = ({
  products,
  current_page,
  onAddToCart
}) => {
  const [pagination, setPagination] = useState({})

  return(
    <div>
      {
        products.map((product) => (
          <ProductCard
            product={product}
            onAddToCart={ onAddToCart }
          />
        ))
      }
    </div>
  )
}

export default ProductList