import React, { useState } from 'react';

import './product-card.css'

const ProductCard = ({
  product,
  onAddToCart
}) => {
  const [quantity, setQuantity] = useState(1);

  const handleAddToCart = () => {
    onAddToCart(product.id, quantity);
  }

  const decrementQuantity = () => {
    if (quantity > 1) {
      setQuantity(quantity - 1);
    }
  }

  const incrementQuantity = () => {
    if (quantity < product.quantity) {
      setQuantity(quantity + 1);
    }
  }

  return (
    <div className="product-card">
      <img src={product.image_url} alt={product.name} style={{ width: '50%', height: '50%' }} />
      <h2>{product.name}</h2>
      <p>{`Price: Rp ${Intl.NumberFormat().format(product.price)}`}</p>
      <div></div>
      <div className="quantity-selector">
        <button onClick={decrementQuantity} disabled={quantity <= 1}>-</button>
        <span>{quantity}</span>
        <button onClick={incrementQuantity} disabled={quantity >= product.quantity}>+</button>
      </div>

      <button className='add-to-cart-button' onClick={handleAddToCart}>Add to Cart</button>
    </div>
  );
}

export default ProductCard