<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'amount',
        'currency',
        'payment_channel',
        'payment_type',
        'payment_channel',
        'dataCapture',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
