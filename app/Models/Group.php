<?php

namespace App\Models;

use App\Models\Meal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'name',
        'partener_id'
    ];

    public function meals()
    {
        return $this->hasMany(Meal::class);
    }

    public function partener()
    {
        return $this->belongsTo(Partener::class);
    }
}
