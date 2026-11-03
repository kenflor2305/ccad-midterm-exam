<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShelterAnimal extends Model
{
    protected $fillable = [
        'animal_type',
        'pet_name',
        'microchip_id',
        'intake_date',
        'spay_neuter_status',
    ];

    protected function casts(): array
    {
        return [
            'intake_date' => 'date',
            'microchip_id' => 'string',
        ];
    }

    public function adoptions(): HasMany
    {
        return $this->hasMany(Adoption::class);
    }

    protected static function booted(): void
    {
        static::saving(function (ShelterAnimal $animal) {
            if ($animal->microchip_id !== null) {
                $animal->microchip_id = strtoupper(
                    trim($animal->microchip_id)
                );
            }
        });
    }
}