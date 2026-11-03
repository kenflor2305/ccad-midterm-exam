<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Adoption extends Model
{
    protected $fillable = [
        'adopter_id',
        'shelter_animal_id',
        'adoption_date',
        'adoption_fee',
        'approval_status',
    ];

    protected function casts(): array
    {
        return [
            'adoption_date' => 'date',
            'adoption_fee' => 'decimal:2',
        ];
    }

    public function adopter(): BelongsTo
    {
        return $this->belongsTo(Adopter::class);
    }

    public function shelterAnimal(): BelongsTo
    {
        return $this->belongsTo(ShelterAnimal::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(AdoptionPayment::class);
    }
}