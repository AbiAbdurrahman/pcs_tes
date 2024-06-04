<?php

namespace App\Rules;

use App\Models\Product;
use App\Models\CartItem;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\ValidationRule;

// if a product quantity is 0, then it's unavailable for purchase
class ValidateEmptyProduct implements ValidationRule {
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
        $product = Product::find($value);

        if ($product->quantity <= 0) {
            $fail('Product unavailable for purchase');
        }
    }

}