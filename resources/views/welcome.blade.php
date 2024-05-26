<x-app-layout>
    <div class="mb-32 mt-20 text-center">
        @auth
            <h1 class="text-2xl font-bold">Hello {{ Auth::user()->nickname }}</h1>
        @else
            <a class="rounded-lg bg-blue-500 px-8 py-4 text-2xl font-bold shadow-md hover:bg-blue-600" href="/login">Log In
                with Discord</a>
        @endauth
    </div>

    <section>
        <h2 class="mb-4 text-lg font-bold">Recent dinos</h2>

        <div class="grid grid-cols-4 gap-8">
            @foreach ($dinos as $dino)
                <x-dino-card :$dino />
            @endforeach
        </div>
    </section>

</x-app-layout>
