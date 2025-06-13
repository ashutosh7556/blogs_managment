<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // 🔗 Relationship: User has many Roles
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // ✅ Check if user has a single role
    public function hasRole($roleName)
    {
        return $this->roles->contains('name', $roleName);
    }

    // ✅ Check if user has any of the given roles
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            return $this->roles->whereIn('name', $roles)->isNotEmpty();
        }
        return $this->hasRole($roles);
    }
}
