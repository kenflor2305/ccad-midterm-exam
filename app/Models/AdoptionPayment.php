<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdoptionPayment extends Model
{
    protected $fillable = [
        'adoption_id',
        'amount',
        'payment_status',
        'paid_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'paid_at' => 'datetime',
        ];
    }

    public function adoption(): BelongsTo
    {
        return $this->belongsTo(Adoption::class);
    }
}