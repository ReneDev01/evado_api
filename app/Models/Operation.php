<?php

namespace App\Models;

use App\Models\Delever;
use App\Models\Customer;
use App\Models\Partener;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Operation extends Model
{
    use HasFactory;
    protected $fillable = [
        'partener_id',
        'customer_id',
        'delever_id',
        'type',
        'price',
        'status',
        'identifier',
        'payment_reference'
    ];

    public function partener()
    {
        return $this->belongsTo(Partener::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function delever()
    {
        return $this->belongsTo(Delever::class);
    }
}
