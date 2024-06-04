<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Managers\Api\CartItem\RemoveManager;
use App\Models\User;
use Illuminate\Http\Request;

class CartItemController extends Controller {

    protected $removeManager;

    public function __construct(
        RemoveManager $removeManager
    ) {
        $this->removeManager = $removeManager;
    }

    public function remove(Request $request) {
        $this->removeManager->execute($request);

        return response()->json(null);
    }
}
