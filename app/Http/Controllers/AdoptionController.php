<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdoptionRequest;
use App\Http\Requests\UpdateAdoptionRequest;
use App\Models\Adoption;
use App\Models\ShelterAnimal;
use App\Services\AdoptionService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdoptionController extends Controller
{
    public function __construct(
        protected AdoptionService $adoptionService
    ) {}

    /**
     * Display a paginated listing of adoptions.
     */
    public function index(Request $request)
{
    $adoptions = \App\Models\Adoption::with(['shelterAnimal', 'adopter'])
        ->orderByDesc('created_at')
        ->paginate(15);

    return view('adoptions.index', compact('adoptions'));
}

    /**
     * Show the form for creating a new adoption.
     */
    public function create()
    {
        $availableAnimals = ShelterAnimal::whereDoesntHave('adoptions', function ($q) {
            $q->where('approval_status', 'Approved');
        })
            ->orderBy('pet_name')
            ->get(['id', 'pet_name', 'animal_type', 'microchip_id', 'spay_neuter_status']);

        return view('adoptions.create', [
            'availableAnimals'  => $availableAnimals,
            'approvalStatuses'  => ['Pending', 'Approved', 'Rejected'],
        ]);
    }

    /**
     * Store a newly created adoption.
     */
    public function store(StoreAdoptionRequest $request)
    {
        $adoption = $this->adoptionService->createAdoption($request->validated());

        return redirect()
            ->route('adoptions.index')
            ->with('success', 'Adoption request recorded successfully.');
    }

    /**
     * Update the specified adoption.
     */
    public function update(UpdateAdoptionRequest $request, $id)
    {
        $adoption = Adoption::with(['shelterAnimal', 'adopter'])->findOrFail($id);

        $this->adoptionService->updateAdoption($adoption, $request->validated());

        return redirect()
            ->route('adoptions.index')
            ->with('success', 'Adoption updated successfully.');
    }
    
}