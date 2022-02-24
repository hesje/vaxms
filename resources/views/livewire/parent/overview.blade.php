<div>
    <h1  class="text-4xl text-red-500 py-2 font-bold pl-8">Dashboard</h1>

    <div class="grid grid-cols-2 gap-8">
        <x-box title="Your Children">
            <x-slot name="actions">
                <div wire:click="addChild" class="text-red-500 cursor-pointer">
                    <x-icon.plus />
                </div>
            </x-slot>

            <table class="w-full table-auto">
                <thead>
                    <tr class="border-b-2 border-red-500 font-bold">
                        <td class="text-red-500">Name</td>
                        <td class="text-red-500">Months old</td>
                        <td class="text-red-500">Unsubscribe</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($children as $child)
                    <tr>
                        <td class="font-semibold text-red-500 cursor-pointer" wire:click="selectChild({{ $child->id }})">
                            {{ $child->name }}</td>
                        <td class="text-red-500">{{ $child->dob->monthsUntil(now())->count() }}</td>
                        <td class="font-semibold text-red-500 cursor-pointer" wire:click="confirmRemoval({{ $child->id }})">
                            <x-icon.x />
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </x-box>

        <div>
            @isset($selected)
            <x-box :title="$selected->name">
                <table class="w-full table-auto">
                    <tbody>
                    <tr class="border-b-2 border-red-500">
                        <td class="text-red-500">Upcoming Vaccinations</td>
                        <td class="text-red-500">Age at administration</td>
                    </tr>
                    @forelse($selected->vaccinations() as $vaccination)
                        <tr>
                            <td class="text-red-500">{{ $vaccination->name }}</td>
                            <td class="text-red-500">{{ $vaccination->pivot->age_at_administration }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2"><small class="text-red-500 text-center w-full">No Upcoming Vaccinations Found</small></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </x-box>
            @endisset
        </div>

    </div>

    <x-modal on="add-child" title="Add Child">
        <div class="space-y-3">
            <x-input.text wire:model.defer="creating.name">Name</x-input.text>
            <x-input.text wire:model.defer="creating.dob">Date</x-input.text>
            <div class="flex justify-end">
                <x-button wire:click="saveChild">Save</x-button>
            </div>
        </div>
    </x-modal>

    @isset($deleting)
        <x-modal on="confirm-removal-child" title="Are you sure?">
            <p>Are you sure you want to unsubscribe {{ $deleting->name }}?</p>
            <x-button wire:click="removeChild()">Yes</x-button>
            <x-button wire:click="closeModal">No</x-button>
        </x-modal>
    @endisset


    <h2  class="text-4xl text-red-500 py-2 font-bold pl-8">Vaccination Overview</h2>
    <div class="grid grid-cols-2 gap-8">
        <x-box title="Overview">
            <table class="w-full table-auto">
                <thead>
                <tr class="border-b-2 border-red-500 font-bold">
                    <td class="text-red-500">Name</td>
                    <td class="text-red-500">Age at administration</td>
                </tr>
                </thead>
                <tbody>
                @foreach($country->vaccinations()->get() as $vaccination)
                    <tr>
                        <td class="text-red-500">{{ $vaccination->acronym}}</td>
                        <td class="text-red-500">{{ $vaccination->pivot->age_at_administration}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-box>
    </div>









    <h3  class="text-4xl text-red-500 py-2 font-bold pl-8">GOVERNMENT WORKER THINGS</h3>


    <div class="grid grid-cols-2 gap-8">
        <x-box title="Overview">
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
                        <td class="text-red-500">{{ $vaccination->acronym}}</td>
                        <td class="text-red-500">{{ $vaccination->pivot->age_at_administration}}</td>
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


