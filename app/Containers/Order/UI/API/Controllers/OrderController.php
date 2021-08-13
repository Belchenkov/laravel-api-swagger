<?php

namespace App\Containers\Order\UI\API\Controllers;


use App\Containers\Order\Models\Order;
use App\Containers\Order\UI\API\Resources\OrderResource;
use App\Ship\Parents\Controllers\ApiController;

class OrderController extends ApiController
{
    public function index()
    {
        $orders = Order::paginate();

        return OrderResource::collection($orders);
    }

    public function show(int $id)
    {
        return new OrderResource(Order::find($id));
    }
}
