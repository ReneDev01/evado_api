<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Operation;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Delever extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $guard = 'delever';

    protected $fillable = [
        'name',
        'surname',
        'phone',
        'password',
        'card_id',
        'solde',
        'birthday',
        'sex',
        'status',
        'fcnToken',
        'is_avalable'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function operations()
    {
        return $this->hasMany(Operation::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
