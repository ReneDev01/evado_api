<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pub extends Model
{
    use HasFactory;
    protected $fillable = [
        'percent',
        'image',
        'description',
        'is_active',
        'promotion'
    ];

    public function partener()
    {
        return $this->belongsTo(Partener::class);
    }
}
