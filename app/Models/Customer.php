<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Place;
use App\Models\Operation;
use App\Models\Information;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $guard = 'customer';
    protected $dateFormat = 'Y-m-d';
    
    protected $fillable = [
        'solde',
        'phone',
        'status',
        'isActive',
        'password',
        'surname',
        'name',
        'birthday',
        'fcnToken'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function operations()
    {
        return $this->hasMany(Operation::class);
    }

    public function places()
    {
        return $this->hasMany(Place::class);
    }

    public function information()
    {
        return $this->hasOne(Information::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
