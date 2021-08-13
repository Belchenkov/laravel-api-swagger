<?php

namespace App\Containers\Order\Models;

use App\Ship\Parents\Models\ModelParent;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends ModelParent
{
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
