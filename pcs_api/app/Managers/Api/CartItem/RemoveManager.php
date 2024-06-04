<?php

namespace App\Managers\Api\CartItem;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Validator;

// remove cart item altogether for a certain product
class RemoveManager {
    public function execute(Request $request): void {
        $validator = Validator::make($request->all(), [
            'cart_item_id' => 'required'
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages(['cart_item_id' => 'id not found']);
        }

        $cart_item_id = $request->input('cart_item_id');
        $cart_item = CartItem::findOrFail($cart_item_id);
        $cart_item->delete();
    }
}
