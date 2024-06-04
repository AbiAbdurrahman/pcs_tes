<?php

namespace App\Managers\Api\Cart;
use App\Models\Product;
use App\Rules\ValidateEmptyProduct;
use Illuminate\Http\Request;
use Validator;

// Add to cart method to insert a singular product with certain quantity
class AddManager {
    public function execute(Request $request) {
        $validator = Validator::make($request->all(), [
            'product_id' => ['required', new ValidateEmptyProduct($request)],
            'quantity' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product_id = $request->input("product_id");
        $quantity = $request->input("quantity");

        $product = Product::find($product_id);

        $cart_item_data = [
          'product_id' => $product->id,
          'quantity' => $quantity
        ];

        // get cart entity
        $user = $request->user();
        $user_cart = $user->cart()->first();
        $user_cart_item = $user_cart->items()->firstWhere('product_id', $product_id);

        // if a product exist in a cart, then update the quantity
        // otherwise, instantiate and create new cart item
        if ($user_cart_item) {
          $user_cart_item->quantity = $user_cart_item->quantity + $quantity;
          $user_cart_item->save();
        } else {
          $user_cart->items()->create($cart_item_data);
        }

        return [
          'id' => $user_cart->id
        ];
    }
}
