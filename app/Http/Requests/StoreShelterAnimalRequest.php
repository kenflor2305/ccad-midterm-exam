<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreShelterAnimalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'animal_type' => [
                'required', 'string', 'max:50',
            ],
            'pet_name' => [
                'nullable', 'string', 'max:100',
            ],
            'microchip_id' => [
                'nullable', 'string', 'max:50',
                'unique:shelter_animals,microchip_id',
            ],
            'intake_date' => [
                'required', 'date', 'before_or_equal:today',
            ],
            'spay_neuter_status' => [
                'required',
                Rule::in([
                    'Pending',
                    'Scheduled',
                    'Completed',
                    'Not Required',
                ]),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'animal_type.required' =>
                'Please provide the animal type.',
            'microchip_id.unique' =>
                'This microchip ID is already registered.',
            'intake_date.before_or_equal' =>
                'The intake date cannot be in the future.',
            'spay_neuter_status.in' =>
                'Select a valid spay/neuter status.',
        ];
    }
}