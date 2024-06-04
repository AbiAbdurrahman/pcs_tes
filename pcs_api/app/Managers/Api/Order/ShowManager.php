<?php

namespace App\Managers\Api\Order;
use App\Models\Order;
use App\Views\OrderItemView;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

// show order and its items
class ShowManager {
    public function execute(string $id, Request $request) {
        $order = Order::findOrFail($id);

        $order_user_id = $order->user_id;

        if ($order_user_id != $request->user()->id) {
          throw ValidationException::withMessages(['user_id' => 'unauthorized']);
        }

        $order_items = $order->load('items')->items;

        $order_items_view = array();

        // for each order items, we'll setup a view model for them
        foreach ($order_items as $item) {
          $order_item_view = new OrderItemView($item);
          array_push($order_items_view, $order_item_view);
        }

        return [
          'id' => $order->id,
          'user_id' => $order->user_id,
          'total_price' => $order->total_price,
          'total_quantity' => $order->total_quantity,
          'total_coupons_received' => $order->total_coupons_received,
          'items' => $order_items_view
        ];
    }
}
