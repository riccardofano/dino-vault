@props(['dino'])

<div class="flex flex-col rounded-lg bg-white/10 p-4">
    <div class="mx-auto h-28 w-28">
        <img class="h-full w-full" src="{{ $dino->discord_url }}" alt="">
    </div>

    <h3 class="mt-2 text-center text-lg font-bold">{{ $dino->name }}</h3>
    <div class="mt-auto flex justify-between text-sm">
        <p>Worth: {{ $dino->worth }} bucks</p>
        <p>Hotness: {{ $dino->hotness }}</p>
    </div>
</div>
