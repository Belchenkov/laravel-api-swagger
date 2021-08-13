<?php

namespace App\Containers\Order\UI\API\Controllers;


use App\Containers\Order\Models\Order;
use App\Containers\Order\UI\API\Resources\OrderResource;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\StreamedResponse;

class OrderController extends ApiController
{
    public function index(): AnonymousResourceCollection
    {
        Gate::authorize('view', 'orders');

        $orders = Order::paginate();

        return OrderResource::collection($orders);
    }

    public function show(int $id): OrderResource
    {
        Gate::authorize('view', 'orders');

        return new OrderResource(Order::find($id));
    }

    public function export(): StreamedResponse
    {
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=orders.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function () {
            $orders = Order::all();
            $file = fopen('php://output', 'w+');

            // Header Row
            fputcsv($file, ['ID', 'Name', 'Email', 'Product Title', 'Price', 'Quantity']);

            // Body
            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->id,
                    $order->name,
                    $order->email,
                    '',
                    '',
                    ''
                ]);

                foreach ($order->orderItems as $orderItem) {
                    fputcsv($file, [
                        '',
                        '',
                        '',
                        $orderItem->product_title,
                        $orderItem->price,
                        $orderItem->quantity
                    ]);
                }

            }
            fclose($file);
        };

        return \Response::stream($callback, 200, $headers);
    }
}
