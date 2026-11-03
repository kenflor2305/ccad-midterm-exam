<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShelterAnimalRequest;
use App\Http\Requests\UpdateShelterAnimalRequest;
use App\Models\ShelterAnimal;
use App\Services\ShelterAnimalService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ShelterAnimalController extends Controller
{
    public function index(): View
    {
        $animals = ShelterAnimal::with('adoptions.adopter')
            ->latest()
            ->paginate(10);

        return view('shelter-animals.index', compact('animals'));
    }

    public function create(): View
    {
        return view('shelter-animals.create');
    }

    public function store(
        StoreShelterAnimalRequest $request,
        ShelterAnimalService $service
    ): RedirectResponse {
        $service->create($request->validated());

        return redirect()
            ->route('shelter-animals.index')
            ->with('success', 'Animal registered successfully.');
    }

    public function update(
        UpdateShelterAnimalRequest $request,
        $id,
        ShelterAnimalService $service
    ): RedirectResponse {
        $service->update((int) $id, $request->validated());

        return redirect()
            ->route('shelter-animals.index')
            ->with('success', 'Animal updated successfully.');
    }
}