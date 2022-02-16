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
                <tbody>
                    <tr>
                        <td class="font-bold text-red-500 cursor-pointer" wire:click="selectChild('Pietje')">Pietje</td>
                        <td class="text-red-500">7 maanden oud</td>
                    </tr>
                </tbody>
            </table>

        </x-box>

        <x-box :title="$childname">

        </x-box>

    </div>
</div>
