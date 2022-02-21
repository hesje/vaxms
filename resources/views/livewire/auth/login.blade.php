<div class="mx-auto w-full md:w-2/3 lg:w-1/2 xl:w-1/3 mt-32">
{{--    <h1  class="text-4xl text-red-500 py-2 font-bold pl-8">Dashboard</h1>--}}

    <x-box title="Log In">
        <x-input.text id="username" wire:model="username">Username</x-input.text>
        @isset($user_id)
            <x-input.text id="auth_code" wire:model="auth_code" placeholder="123456">Verification Code</x-input.text>
            <div class="flex justify-end mt-3">
                <x-button wire:click="tryLogin">Log In</x-button>
            </div>
        @else
            <div class="flex justify-end mt-3">
                <x-button wire:click="sendAuthCode">Send Code</x-button>
            </div>
        @endisset
    </x-box>

</div>
