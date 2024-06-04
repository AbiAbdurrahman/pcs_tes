<?php

namespace App\Builders;
use App\Models\Coupon;
use App\Models\OrderItem;
use App\Models\User;

class CouponBuilder
{
    protected $cart_item;

    public function __construct(bool $is_product_coupon, User $user) {
      $this->is_product_coupon = $is_product_coupon;
      $this->user = $user;
    }

    public function initialize() {
      $coupon = new Coupon;

      $code = $this->is_product_coupon ? 'BORONG123' : 'BONUS234';

      $coupon->code = $code;
      $coupon->user_id = $this->user->id;

      return $coupon;
    }
}
