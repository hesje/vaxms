<div>
    <h1  class="text-4xl text-red-500 py-2 font-bold pl-8">Goverment Worker Dashboard</h1>

    <div class="grid grid-cols-2 gap-8">
        <x-box title="Overview of vaccinations in {{ $country->name }}">
            <x-slot name="actions">
                <div wire:click="addVaccination" class="text-red-500 cursor-pointer">
                    <x-icon.plus />
                </div>
            </x-slot>

            <table class="w-full table-auto">
                <thead>
                    <tr class="border-b-2 border-red-500 font-bold">
                        <td class="text-red-500">Name</td>
                        <td class="text-red-500">Age at administration</td>
                        <td class="text-red-500">Remove</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($country->vaccinations()->get() as $vaccination)
                    <tr>
                        <td class="text-red-500">{{ $vaccination->name }}</td>
                        <td class="text-red-500">{{ $vaccination->pivot->age_at_administration }}</td>
                        <td class="font-semibold text-red-500 cursor-pointer" wire:click="confirmRemovalVaccination({{ $vaccination->id }})"><x-icon.x /></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-box>
    </div>

    <x-modal on="add-vaccination" title="Add Vaccination">
        <div class="space-y-3">
            <x-input.text wire:model.defer="creatingVax.acronym">Acronym</x-input.text>
            <x-input.text wire:model.defer="creatingVax.name">Name</x-input.text>
            <x-input.text wire:model.defer="age">Age at administration (weeks)</x-input.text>
            <div class="flex justify-end">
                <x-button wire:click="saveVaccination">Save</x-button>
            </div>
        </div>
    </x-modal>

    @isset($deletingVax)
        <x-modal on="confirm-removal-vaccination" title="Are you sure?">
            <p>Are you sure you want to remove {{ $deletingVax->acronym }}?</p>
            <x-button wire:click="removeVaccination()">Yes</x-button>
            <x-button wire:click="closeModal">No</x-button>
        </x-modal>
    @endisset
</div>
