<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $casts = [
        'meal_ids' => 'array'
    ];
    protected $fillable = [
        'date',
        'stauts',
        'delevery_price',
        'longitude',
        'latitude',
        'delever_id',
        'customer_id',
        'place_id',
        'is_confirmed',
        'phone',
        'is_taked',
        'is_delived',
        'partener_id',
        'order_date',
        'code',
        'delever_price',
        'meal_ids' 
    ];

    public function partener()
    {
        return $this->belongsTo(Partener::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function delever()
    {
        return $this->belongsTo(Delever::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function meals()
    {
        return $this->belongsToMany(Meal::class, 'order_meal')
        ->withPivot('quantity');
    }


    
}
