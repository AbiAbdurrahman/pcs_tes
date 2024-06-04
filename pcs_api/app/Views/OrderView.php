<?php

namespace App\Views;
use Spatie\ViewModels\ViewModel;
use App\Models\Order;
use App\Models\OrderItem;

class OrderView extends ViewModel
{
    protected $cart_item;

    public function __construct(Order $order) {
      $this->id = $order->id;
      $this->user_id = $order->user_id;
      $this->total_price = $order->total_price;
      $this->total_quantity = $order->total_quantity;
      $this->total_coupons_received = $order->total_coupons_received;
      $this->items = $order->load('items')->items;
    }
}