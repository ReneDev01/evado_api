<?php

namespace App\Models;

use App\Models\Type;
use App\Models\Operation;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Partener extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;
    
    protected $fillable = [
        'name',
        'logo',
        'phone',
        'solde',
        'longitude',
        'latitude',
        'type_id',
        'active',
        'start_hours',
        'end_hours',
        'status',
        'neighboord',
        'password',
        'fcnToken'
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function pubs()
    {
        return $this->hasMany(Pub::class);
    }

    public function operations()
    {
        return $this->hasMany(Operation::class);
    }

    public function meals()
    {
        return $this->hasMany(Meal::class);
    }

    public function groups()
    {
        return $this->belongsTo(Group::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
