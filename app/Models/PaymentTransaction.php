<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'provider',
        'provider_payment_id',
        'provider_preference_id',
        'status',
        'amount',
        'currency',
        'external_reference',
        'processed_at',
        'raw_payload',
    ];

    protected function casts(): array
    {
        return [
            'processed_at' => 'datetime',
            'raw_payload' => 'array',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
