@extends('layouts.app')

@section('title', 'Adoptions')

@section('content')
<div class="py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Adoption Records</h1>
        <a href="{{ url('/adoptions/create') }}"
           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
            + New Adoption Request
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Animal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Microchip</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Adopter</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Phone</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fee</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($adoptions as $adoption)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $adoption->shelterAnimal->pet_name ?? 'N/A' }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $adoption->shelterAnimal->animal_type ?? '' }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm font-mono text-gray-700">
                            {{ $adoption->shelterAnimal->microchip_id ?? '—' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ $adoption->adopter->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $adoption->adopter->phone ?? '—' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            ${{ number_format($adoption->adoption_fee, 2) }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full
                                @if($adoption->approval_status === 'Approved') bg-green-100 text-green-800
                                @elseif($adoption->approval_status === 'Rejected') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                {{ $adoption->approval_status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $adoption->adoption_date ? $adoption->adoption_date->format('M d, Y') : '—' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                            No adoption records found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $adoptions->links() }}
    </div>
</div>
@endsection