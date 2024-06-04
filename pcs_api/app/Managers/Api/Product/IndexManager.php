<?php

namespace App\Managers\Api\Product;
use App\Helpers\PaginationHelper;
use App\Models\Product;
use Illuminate\Http\Request;

// get all products + pagination
class IndexManager {
    public function execute(Request $request) {
        $per_page = $request->input("per_page",10);

        $products = Product::all();

        $products = PaginationHelper::paginate($products, $per_page);

        return $products;
    }
}
