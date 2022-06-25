<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MicrowaveResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'power',
        'time',
        'product_id',
        'weight',
        'temperature'
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
