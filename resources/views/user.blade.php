<x-app-layout>
    <x-slot:header>
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ $user->name }}'s Dinos
        </h2>
    </x-slot:header>

    <section class="grid grid-cols-auto-fit-200 gap-4 text-gray-800 dark:text-gray-200">
        @foreach ($dinos as $dino)
            <x-dino-card :$dino />
        @endforeach

        {{ $dinos->links() }}
    </section>
</x-app-layout>
