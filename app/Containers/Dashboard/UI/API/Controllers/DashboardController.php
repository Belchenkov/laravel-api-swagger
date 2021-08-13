<?php

namespace App\Containers\Dashboard\UI\API\Controllers;


use App\Containers\Dashboard\UI\API\Resources\ChartResource;
use App\Containers\Order\Models\Order;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DashboardController extends ApiController
{
    public function chart(): AnonymousResourceCollection
    {
        \Gate::authorize('view', 'orders');

        $orders = Order::query()
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->selectRaw(
    "DATE_FORMAT(orders.created_at, '%Y-%m-%d') as date, sum(order_items.quantity * order_items.price) as sum"
            )
            ->groupBy('date')
            ->get();

        return ChartResource::collection($orders);
    }
}
