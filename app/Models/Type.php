<?php

namespace App\Models;

use App\Models\Partener;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'image'
    ];

    public function parteners()
    {
        return $this->hasMany(Partener::class);
    }
}
