<?php

namespace App\Views;
use Spatie\ViewModels\ViewModel;
use App\Models\OrderItem;

class OrderItemView extends ViewModel
{
    protected $order_item;

    public function __construct(OrderItem $order_item) {
      $this->id = $order_item->id;
      $this->product_id = $order_item->product_id;
      $this->name = $order_item->product->name;
      $this->quantity = $order_item->quantity;
      $this->total_price = $order_item->total_price;
      $this->per_item_price = $order_item->per_item_price;
      $this->created_at = $order_item->created_at;
    }
}
