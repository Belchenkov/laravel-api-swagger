<?php

namespace App\Containers\Role\Models;

use App\Containers\Permissions\Models\Permission;
use App\Ship\Parents\Models\ModelParent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
class Role extends ModelParent
{
    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }
}
