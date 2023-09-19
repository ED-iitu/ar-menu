<?php
namespace App\Http\Controllers\Api\v1;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController
{
    public function create(Request $request)
    {
        $order = new Order();

        $order->delivery_method_id = $request->get('deliveryMethod');
        $order->user_id            = 1;
        $order->payment_type_id    = 1;
        $order->address_info       = $request->get('address');
        $order->city_id            = 1;
        $order->comment            = $request->get('comment') ?? null;
        $order->phone              = $request->get('phone');
        $order->status             = 1;
        $totalSum                  = 0;
        $order->save();

        $orderItems = $request->get('basket');

        foreach ($orderItems as $item) {
            foreach ($item->products as $product) {
                $orderItem = new OrderItem();

                $orderItem->order_id       = $order->id;
                $orderItem->item_id        = $product->id;
                $orderItem->item_count     = $product->quantity;
                $orderItem->fact_price     = $product->price;
                $orderItem->original_price = $product->price;

                $totalSum += $orderItem->fact_price;

                $orderItem->save();
            }
        }

        $order->total_sum = $totalSum;

        $order->save();

        return true;
    }
}
