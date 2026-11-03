<?php

namespace App\Services;

use App\Models\Adoption;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AdoptionService
{
    public function create(array $data): Adoption
    {
        return DB::transaction(function () use ($data) {
            $data['approval_status'] = 'Pending';
            $data['adoption_date'] = null;

            return Adoption::create($data);
        });
    }

    public function update(
        int $id,
        array $data
    ): Adoption {
        return DB::transaction(function () use ($id, $data) {
            $adoption = Adoption::query()
                ->lockForUpdate()
                ->findOrFail($id);

            $newStatus = $data['approval_status']
                ?? $adoption->approval_status;

            if (
                $newStatus === 'Approved'
                && $adoption->approval_status !== 'Approved'
            ) {
                $animal = $adoption->shelterAnimal()
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($animal->spay_neuter_status !== 'Completed') {
                    throw ValidationException::withMessages([
                        'approval_status' =>
                            'Cannot approve adoption until '
                            . 'spay/neuter status is Completed.',
                    ]);
                }

                $data['adoption_date'] = now()->toDateString();
            }

            $adoption->fill($data);
            $adoption->save();

            return $adoption->refresh();
        });
    }
}