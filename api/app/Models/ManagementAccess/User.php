<?php

namespace App\Models\ManagementAccess;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Laravel\Sanctum\HasApiTokens;
use App\Models\ManagementAccess\Role;
use Illuminate\Notifications\Notifiable;
use App\Models\ManagementAccess\UserDetail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    protected $table = 'users';

    protected $guarded = ['id'];

    protected $with = ['detail'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsToMany(Role::class, 'roles_users', 'user_id', 'role_id');
    }

    // public function hasRole(string $role)
    // {
    //     return $this->role()->where('name', $role)->exists();
    // }

    public function detail()
    {
        return $this->hasOne(UserDetail::class, 'user_id');
    }

    public function assignRole(int $role)
    {
        $this->role()->sync($role, false);
    }
}
