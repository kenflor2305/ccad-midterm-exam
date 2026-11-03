@extends('layouts.app')

@section('title', 'Shelter Animals')

@section('content')
<div class="py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Shelter Animals</h1>
        <a href="{{ url('/shelter-animals/create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
            + Add New Animal
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pet Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Microchip ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Intake Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Spay/Neuter</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Adoptions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($animals as $animal)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                            {{ $animal->pet_name }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $animal->animal_type }}
                        </td>
                        <td class="px-6 py-4 text-sm font-mono text-gray-700">
                            {{ $animal->microchip_id }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $animal->intake_date ? $animal->intake_date->format('M d, Y') : '—' }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full
                                @if($animal->spay_neuter_status === 'Completed') bg-green-100 text-green-800
                                @elseif($animal->spay_neuter_status === 'Pending') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ $animal->spay_neuter_status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $animal->adoptions->count() }} record(s)
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                            No animals found in the shelter.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $animals->links() }}
    </div>
</div>
@endsection