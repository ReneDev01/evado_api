<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
use App\Models\Order;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'surname',
        'phone',
        'password',
        'sexe',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function promos()
    {
        return $this->hasMany(Promo::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function isAdmin()
    {
        return $this->roles()->where('slug', 'administrateur')->first();
    }

    public function isSuperviser()
    {
        return $this->roles()->where('slug', 'superviseur')->first();
    }

    public function isGestionnaire()
    {
        return $this->roles()->where('slug', 'gestionnaire')->first();
    }

    public function isCaishier()
    {
        return $this->roles()->where('slug', 'caisse')->first();
    }
}
