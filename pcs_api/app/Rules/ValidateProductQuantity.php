<?php

namespace App\Rules;

use App\Models\Product;
use App\Models\Cart;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\ValidationRule;

// if a product quantity is below the requested quantity, then its out of stock
class ValidateProductQuantity implements ValidationRule {
    protected $request;

    public function __construct(Request $request = null) {
      $this->request = $request;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cart = Cart::find($value);

        $cart_items = $cart->load('items')->items;

        foreach ($cart_items as $cart_item) {

          $product = $cart_item->product;
          if ($cart_item->quantity > $product->quantity) {
              $fail("Product with the name {$product->name} and ID {$product->quantity} is out of stock");
          }
        }
    }

}