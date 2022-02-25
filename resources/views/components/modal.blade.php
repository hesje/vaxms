@props(['on', 'title'])

<div
    x-data="{ open: false }"
    x-cloak
    x-show="open"
    x-on:{{ $on }}.window="open = true"
    x-on:close-modal.window="open = false"
    class="flex bg-opacity-60 bg-white fixed inset-0 h-screen z-40 px-5 overscroll-none"
>
    <div class="rounded-2xl bg-white px-8 py-5 border-4 border-red-500/20 bg-white mx-auto my-auto w-full md:w-2/3 lg:w-1/2 2xl:1/3" x-on:click.away="open = false">
        <div class="flex items-center justify-between space-x-3 mb-3">
            <h3 class="text-2xl text-red-500 font-bold">{{ $title }}</h3>
                <div class="flex flex-row">
                    <div x-on:click="open = false" class="text-red-500 cursor-pointer">
                        <x-icon.x/>
                    </div>
                    @isset($actions)
                        {{ $actions }}
                    @endisset
                </div>
        </div>

        {{ $slot }}
    </div>
</div>
