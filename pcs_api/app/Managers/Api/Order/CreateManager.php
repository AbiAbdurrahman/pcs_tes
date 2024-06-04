<?php

namespace App\Managers\Api\Order;
use App\Builders\OrderItemBuilder;
use App\Builders\CouponBuilder;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Rules\ValidateProductQuantity;
use App\Views\OrderView;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Validator;

use Illuminate\Support\Facades\DB;

// Create order
class CreateManager {
    public function execute(Request $request) {
        $cart_id = $request->input('cart_id');
        $cart = Cart::findOrFail($cart_id);
        $cart_items = $cart->load('items')->items;

        $validator = Validator::make($request->all(), [
            'cart_id' => ['required', new ValidateProductQuantity($request)]
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        DB::beginTransaction();

        try {
            $order_items_data = array();

            $subtotal = 0;
            $total_item_quantity = 0;
            $product_coupons_amount = 0;

            // Same as showing cart items on the previous codes,
            // for every cart items, we'll instantiate its own
            // order item based on the data of the cart item.
            // Additionally, we'll increment again the subtotal, quantity,
            // and the coupon. And here, we also delete its corresponding CartItem
            foreach ($cart_items as $item) {
              $order_item_data = new OrderItemBuilder($item);
              $order_item_data = $order_item_data->initialize();

              array_push($order_items_data, $order_item_data);

              $subtotal += $order_item_data->total_price;
              $total_item_quantity += $order_item_data->quantity;

              // if the total price for an order item is above 50k, give a coupon
              if ($order_item_data->total_price > 50_000) $product_coupons_amount++;

              $item->delete();
            }

            // for every 100k increment, give a coupon
            $total_purchase_coupons_amount = floor($subtotal / 100_000);

            // generate product coupons
            for ($i = 0; $i < $product_coupons_amount; $i++){
              $coupon_data = new CouponBuilder(true, $request->user());
              $coupon_data = $coupon_data->initialize();

              $coupon_data->save();
            }

            // generate 100k increment coupon
            for ($i = 0; $i < $total_purchase_coupons_amount; $i++){
              // code to repeat here
              $coupon_data = new CouponBuilder(false, $request->user());
              $coupon_data = $coupon_data->initialize();

              $coupon_data->save();
            }

            // create Order
            $order = Order::create([
              'user_id' => $request->user()->id,
              'total_price' => $subtotal,
              'total_quantity' => $total_item_quantity,
              'total_coupons_received' => $product_coupons_amount + $total_purchase_coupons_amount
            ]);

            // create OrderItem and update product quantity
            foreach ($order_items_data as $item_data) {
              # code...
              $item_data->order_id = $order->id;

              $product = Product::find($item_data->product_id);

              $current_product_quantity = $product->quantity;
              $new_quantity = $current_product_quantity - $item_data->quantity;

              $product->quantity = $new_quantity;

              $item_data->save();
              $product->save();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json($th, 404);
        }

        DB::commit();

        $order_view = new OrderView($order);
        return $order_view;
    }
}
