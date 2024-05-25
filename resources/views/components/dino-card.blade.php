@props(['dino'])

<div class="min-h-60 flex flex-col rounded-lg bg-white/10 p-4">
    <div class="relative mx-auto h-28 w-28">
        {{-- <img class="h-full w-full" src="{{ $dino->discord_url }}" alt=""> --}}

        <x-dino-part filename="{{ $dino->body }}" />
        <x-dino-part filename="{{ $dino->mouth }}" />
        <x-dino-part filename="{{ $dino->eyes }}" />
    </div>

    <h3 class="mt-4 text-center text-lg font-bold">{{ $dino->name }}</h3>
    <div class="mt-auto flex justify-between text-sm">
        <p>Worth: {{ $dino->worth }} bucks</p>
        <p>Hotness: {{ $dino->hotness }}</p>
    </div>
</div>
