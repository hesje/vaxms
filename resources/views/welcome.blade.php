@extends('layouts.app')

@section('content')

    <h1 class="text-4xl text-red-500 py-2 font-bold pl-8">Welcome to VaxMS</h1>

    <div class="grid grid-cols-3 gap-8">

        <div class="col-span-2">
            <x-box>
                <div class="py-6">
                    <a href="https://t.me/VaxMS_bot"
                       class="rounded-2xl bg-blue-400 text-white font-bold hover:bg-blue-500 text-lg px-8 py-5">
                        Sign Up through Telegram
                    </a>
                </div>

            </x-box>
        </div>

        <x-box title="Available in">
            <ul class="list-disc pl-5 text-red-500">
                @foreach(\App\Models\Country::limit(10)->get() as $country)
                    <li>{{ $country->name }}</li>
                @endforeach
            </ul>

            <div class="mt-3">
                <a href="{{ route('governmentworker-dashboard') }}">
                    <x-button>Government Dashboard</x-button>
                </a>
            </div>
        </x-box>

    </div>

@endsection
