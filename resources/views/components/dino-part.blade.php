@props(['filename'])

<img class="absolute h-full w-full" src="{{ Vite::asset('resources/assets/fragments/' . $filename) }}" alt="">
