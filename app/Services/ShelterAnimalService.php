<?php

namespace App\Services;

use App\Models\ShelterAnimal;
use Illuminate\Support\Facades\DB;

class ShelterAnimalService
{
    public function create(array $data): ShelterAnimal
    {
        return DB::transaction(function () use ($data) {
            $data = $this->sanitize($data);

            return ShelterAnimal::create($data);
        });
    }

    public function update(
        int $id,
        array $data
    ): ShelterAnimal {
        return DB::transaction(function () use ($id, $data) {
            $animal = ShelterAnimal::query()
                ->lockForUpdate()
                ->findOrFail($id);

            $animal->fill($this->sanitize($data));
            $animal->save();

            return $animal->refresh();
        });
    }

    private function sanitize(array $data): array
    {
        foreach (['animal_type', 'pet_name', 'microchip_id'] as $field) {
            if (isset($data[$field])) {
                $data[$field] = trim($data[$field]);
            }
        }

        if (!empty($data['microchip_id'])) {
            $data['microchip_id'] = strtoupper(
                $data['microchip_id']
            );
        }

        return $data;
    }
}