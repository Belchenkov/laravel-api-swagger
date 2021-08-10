<?php

namespace App\Containers\Role\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @mixin \Eloquent
 */
class Role extends Model
{
    protected $fillable = [
        'name'
    ];

    public $timestamps = false;
}
