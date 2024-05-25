<x-app-layout>
    <x-slot:header>
        <h2 class="text-xl font-semibold leading-tight"">
            {{ $dino->name }}
        </h2>
    </x-slot:header>

    <section>
        <div class="mx-auto max-w-max rounded-lg bg-white/10 p-8 text-center">
            <div class="rendering-crisp-edges relative mx-auto h-56 w-56">
                {{-- <img class="h-full w-full" src="{{ $dino->discord_url }}" alt=""> --}}

                <x-dino-part filename="{{ $dino->body }}" />
                <x-dino-part filename="{{ $dino->mouth }}" />
                <x-dino-part filename="{{ $dino->eyes }}" />
            </div>

            <h3 class="mt-4 text-lg font-bold">Owned by:
                <a href="/users/{{ $dino->owner->id }}" class="underline">{{ $dino->owner->name }}</a>
            </h3>

            <div class="mt-4">
                <div class="flex justify-center gap-8">
                    <h4>Worth: {{ $dino->worth }} bucks</h4>
                    <h4>Hotness: {{ $dino->hotness }}</h4>
                </div>
                <div class="mt-2 flex justify-center -space-x-2">
                    @foreach ($dino->coveters as $coveter)
                        <a href="/users/{{ $coveter->user->id }}/all">
                            <img class="aspect-square h-10 w-10 rounded-full border-2 border-green-600 bg-black"
                                src="{{ $coveter->user->avatar }}" alt="">
                        </a>
                    @endforeach
                    @foreach ($dino->shunners as $shunner)
                        <a href="/users/{{ $shunner->user->id }}/all">
                            <img class="aspect-square h-10 w-10 rounded-full border-2 border-red-600 bg-black"
                                src="{{ $shunner->user->avatar }}" alt="">
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mx-auto mt-8 flex max-w-max items-center gap-8">
            <form action="/dinos/{{ $dino->id }}/covet" method="post">
                <button class="rounded-md bg-green-600 px-4 py-2 text-lg">Covet</button>
            </form>
            <form action="/dinos/{{ $dino->id }}/shun" method="post">
                <button class="rounded-md bg-red-600 px-4 py-2 text-lg">Shun</button>
            </form>
            <form action="/dinos/{{ $dino->id }}/favourite" method="post">
                <button class="rounded-md bg-gray-500 px-4 py-2 text-lg">Favourite</button>
            </form>
        </div>
    </section>
</x-app-layout>
