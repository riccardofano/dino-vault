<x-app-layout>
    <x-slot:header>
        <h2 class="text-xl font-semibold leading-tight"">
            {{ $user->name }}'s Dinos
        </h2>
    </x-slot:header>

    <nav class="flex justify-between">
        <h2 class="text-lg font-bold">{{ ucfirst($kind) }} Dinos</h2>

        <div>
            <a href=""></a>
            <a href=""></a>
            <a href=""></a>
        </div>
    </nav>


    <section>
        <div class="grid grid-cols-auto-fit-200 gap-4 text-gray-800 dark:text-gray-200">
            @foreach ($dinos as $dino)
                <x-dino-card :$dino />
            @endforeach
        </div>

        <div class="mt-4">

            {{ $dinos->links() }}
        </div>
    </section>
</x-app-layout>
