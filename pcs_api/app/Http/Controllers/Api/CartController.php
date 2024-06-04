<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Managers\Api\Cart\AddManager;
use App\Managers\Api\Cart\ShowManager;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller {

    protected $addManager;
    protected $showManager;

    public function __construct(
        AddManager $addManager,
        ShowManager $showManager
    ) {
        $this->addManager = $addManager;
        $this->showManager = $showManager;
    }

    public function addToCart(Request $request) {
        $cart = $this->addManager->execute($request);

        return response()->json($cart);
    }

    public function show(Request $request) {
      $cart_items = $this->showManager->execute($request);

      return response()->json($cart_items);
  }
}
