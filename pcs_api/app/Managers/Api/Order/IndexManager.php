<?php

namespace App\Managers\Api\Order;
use App\Helpers\PaginationHelper;
use App\Models\Order;
use Illuminate\Http\Request;

// get all orders
class IndexManager {
    public function execute(Request $request) {
        $per_page = $request->input("per_page",10);
        $user     = $request->user();

        $orders = Order::where('user_id', $user->id)->get();

        $orders = PaginationHelper::paginate($orders, $per_page);

        return $orders;
    }
}
