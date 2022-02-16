@props(['title'])

<div {{ $attributes->merge(['class' => 'rounded-2xl bg-white px-8 py-5 border-4 border-red-500/20']) }} >
    @isset($title)
        <div class="flex items-center justify-between space-x-3 mb-3">
            <h3 class="text-2xl text-red-500 font-bold">{{ $title }}</h3>
            @isset($actions)
                <div class="flex flex-row">
                    {{ $actions }}
                </div>
            @endisset
        </div>
    @endisset

    {{ $slot }}
</div>
