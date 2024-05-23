<x-app-layout>
    <x-slot:header>
        <h2 class="text-xl font-semibold leading-tight"">
            {{ $user->name }}'s Dinos
        </h2>
    </x-slot:header>

    <nav class="my-4 flex justify-between">
        <h2 class="text-lg font-bold">{{ ucfirst($kind) }} Dinos</h2>

        <div class="divide-x divide-white/30 [&>*]:px-4">
            <x-nav-kind-link :$user kind="all">All</x-nav-kind-link>
            <x-nav-kind-link :$user kind="favourite">Favourite</x-nav-kind-link>
            {{-- <x-nav-kind-link :$user kind="trash">Trash</x-nav-kind-link> --}}
            {{-- FIXME: now it's so I stop clicking on it --}}
            <span>Trash</span>
            <x-nav-kind-link :$user kind="coveted">Coveted</x-nav-kind-link>
            <x-nav-kind-link :$user kind="shunned">Shunned</x-nav-kind-link>
        </div>
    </nav>


    <section>
        <div class="grid grid-cols-4 gap-8 text-gray-800 dark:text-gray-200">
            @foreach ($dinos as $dino)
                <x-dino-card :$dino />
            @endforeach
        </div>

        <div class="mt-4">

            {{ $dinos->links() }}
        </div>
    </section>
</x-app-layout>
