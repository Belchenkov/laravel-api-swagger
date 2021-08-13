<?php

namespace App\Containers\Order\Data\Seeders;

use App\Containers\Order\Models\Order;
use App\Containers\Order\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        factory(Order::class, 30)
            ->create()
            ->each(function (Order $order) {
                factory(OrderItem::class, random_int(1, 5))->create([
                   'order_id' => $order->id
                ]);
            });
    }
}
