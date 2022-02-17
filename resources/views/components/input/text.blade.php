<div class="flex flex-col">
    <label for="{{$attributes['id']}}" class="w-full text-red-500/50 pl-3">{{ $slot }}</label>
    <input type="text" {{ $attributes->merge(['class' => 'rounded-2xl px-3 py-2 border-2 border-red-500/20 focus:border-red-500 focus:outline-none text-black']) }}>
    @error($attributes['id'])
    <x-input.error :msg="$message" />
    @enderror
</div>
