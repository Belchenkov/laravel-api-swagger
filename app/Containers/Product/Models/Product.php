<?php

namespace App\Containers\Product\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $image
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\Product\Models\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\Product\Models\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\Product\Models\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\Product\Models\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\Product\Models\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\Product\Models\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\Product\Models\Product whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\Product\Models\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\Product\Models\Product whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\Product\Models\Product whereUpdatedAt($value)
 */
class Product extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'price'
    ];
}
