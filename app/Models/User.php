<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    protected $fillable = [
        'name', 'email', 'password', 'role', 'status'
    ];

    protected $attributes = [
        'role' => 'User',
        'status' => 'Active',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->role === 'Admin';
    }
}
