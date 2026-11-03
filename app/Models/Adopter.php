<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Adopter extends Model
{
    protected $fillable = ['name', 'phone', 'address'];

    public function adoptions(): HasMany
    {
        return $this->hasMany(Adoption::class);
    }
}