<?php

namespace App\Containers\Role\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\Role\Models\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\Role\Models\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\Role\Models\Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\Role\Models\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\Role\Models\Role whereName($value)
 */
class Role extends Model
{
    protected $fillable = [
        'name'
    ];

    public $timestamps = false;
}
