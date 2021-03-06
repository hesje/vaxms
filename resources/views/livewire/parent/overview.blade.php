<div class="pb-12">
    <h1  class="text-4xl text-red-500 py-2 font-bold pl-8">Dashboard</h1>

    <div class="grid grid-cols-2 gap-8">
        <div>
            <x-box title="Your Children">
                <x-slot name="actions">
                    <div wire:click="addChild" class="text-red-500 cursor-pointer">
                        <x-icon.plus/>
                    </div>
                </x-slot>

                <table class="w-full table-auto">
                    <thead>
                        <tr class="border-b-2 border-red-500 font-bold">
                            <td class="text-red-500">Name</td>
                            <td class="text-red-500">Age in weeks</td>
                            <td class="text-red-500">Date of Birth</td>
                            <td class="text-red-500">Unsubscribe</td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($children as $child)
                        <tr>
                            <td class="font-semibold text-red-500 cursor-pointer"
                                wire:click="selectChild({{ $child->id }})">
                                {{ $child->name }}</td>
                            <td class="text-red-500">{{ $child->ageInWeeks }}</td>
                            <td class="text-red-500">{{ $child->dob->isoFormat('ll') }}</td>
                            <td class="font-semibold text-red-500 cursor-pointer"
                                wire:click="confirmRemoval({{ $child->id }})">
                                <x-icon.x/>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </x-box>
        </div>

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
</div>


