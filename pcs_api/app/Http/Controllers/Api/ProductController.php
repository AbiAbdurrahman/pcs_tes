<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Managers\Api\Product\IndexManager;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller {

    protected $indexManager;

    public function __construct(
        IndexManager $indexManager
    ) {
        $this->indexManager = $indexManager;
    }

    public function index(Request $request) {
        $products = $this->indexManager->execute($request);

        return response()->json($products);
    }
}
