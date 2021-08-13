<?php

namespace App\Containers\Order\Models;

use App\Ship\Parents\Models\ModelParent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends ModelParent
{
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
