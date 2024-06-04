<?php

namespace App\Views;
use Spatie\ViewModels\ViewModel;
use App\Models\CartItem;

class CartItemView extends ViewModel
{
    protected $cart_item;

    public function __construct(CartItem $cart_item) {
      $this->id = $cart_item->id;
      $this->product_id = $cart_item->product_id;
      $this->name = $cart_item->product->name;
      $this->quantity = $cart_item->quantity;
      $this->singular_price = $cart_item->product->price;
      $this->total_price = $this->generateTotalPrice();
      $this->coupon_applicable = $this->checkCouponEligibility();
    }

    private function generateTotalPrice() {
      $singular_price = $this->singular_price;
      $quantity_bought = $this->quantity;

      $total_price = $singular_price * $quantity_bought;

      return $total_price;
    }

    private function checkCouponEligibility() {

      return $this->total_price > 50_000;
    }
}
