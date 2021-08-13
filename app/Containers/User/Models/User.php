<?php

namespace App\Containers\User\Models;

use App\Containers\Role\Models\Role;
use App\Ship\Parents\Models\UserModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Passport\HasApiTokens;

/**
 * App\User
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $password
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @mixin \Eloquent
 * @property int $role_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Containers\Role\Models\Role $role
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\User\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\User\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\User\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\User\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\User\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\User\Models\User whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\User\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\User\Models\User whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\User\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\User\Models\User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Containers\User\Models\User whereUpdatedAt($value)
 */
class User extends UserModel
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function perms()
    {
        return $this->role->permissions->pluck('name');
    }
}
