<?php

namespace App\Builders;
use Spatie\ViewModels\ViewModel;
use App\Models\CartItem;
use App\Models\OrderItem;

// Builder for creating order items
class OrderItemBuilder
{
    protected $cart_item;

    public function __construct(CartItem $cart_item) {
      $this->cart_item = $cart_item;
      $this->product = $cart_item->product;
      $this->order_item = new OrderItem;
    }

    public function initialize() {
      $this->order_item->product_id = $this->cart_item->product_id;
      $this->order_item->quantity = $this->cart_item->quantity;
      $this->order_item->per_item_price = $this->product->price;
      $this->order_item->total_price = $this->generateTotalPrice();

      return $this->order_item;
    }

    // generate total price for a singular order item
    private function generateTotalPrice() {
      $singular_price = $this->order_item->per_item_price;
      $quantity_bought = $this->order_item->quantity;

      $total_price = $singular_price * $quantity_bought;

      return $total_price;
    }
}
