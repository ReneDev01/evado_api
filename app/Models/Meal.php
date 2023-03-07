<?php

namespace App\Models;

use App\Models\Group;
use App\Models\Order;
use App\Models\Promo;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Meal extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'name',
        'price',
        'description',
        'slug',
        'cooking_time',
        'partener_id',
        'category_id',
        'group_id',
    ];


    public function promos()
    {
        return $this->hasMany(Promo::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_meal')
        ->withPivot('quantity');
    }

    public function partener()
    {
        return $this->belongsTo(Partener::class);
    }
}
