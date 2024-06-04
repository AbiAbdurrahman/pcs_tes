<?php

namespace App\Managers\Api\Cart;
use App\Views\CartItemView;
use Illuminate\Http\Request;

// Show cart along with its item
class ShowManager {
    public function execute(Request $request) {
        $cart = $request->user()->cart()->first();

        $cart_items = $cart->load('items')->items;

        $cart_items_view = array();

        $subtotal = 0;
        $product_coupon_potential = 0;

        // for each of the cart item model, we'll setup
        // their individual view model as well as incrementally
        // update the subtotal and coupon availability
        foreach ($cart_items as $item) {
          $cart_item_view = new CartItemView($item);
          array_push($cart_items_view, $cart_item_view);

          $subtotal += $cart_item_view->total_price;
          if ($cart_item_view->coupon_applicable) $product_coupon_potential++;
        }

        // for every 100k Rupiah increment, create a coupon.
        // this will count the amount of coupon relative to the 100k increment
        $total_purchase_coupon_potential = floor($subtotal / 100_000);

        return [
          'items' => $cart_items_view,
          'subtotal' => $subtotal,
          'coupon_potential' => [
            'amount' => ($product_coupon_potential + $total_purchase_coupon_potential),
            'from_product' => ($product_coupon_potential),
            'from_total_purchase' => ($total_purchase_coupon_potential)
          ]
        ];
    }
}
