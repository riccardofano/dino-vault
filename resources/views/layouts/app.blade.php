<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100 font-sans text-gray-800 antialiased dark:bg-gray-900 dark:text-gray-200">
    <header class="bg-white px-8 py-4 shadow dark:bg-gray-800">
        <div class="mx-auto flex max-w-7xl items-center justify-between">
            <a class="hover:underline" href="/">
                <div class="text-xl font-bold">Banana Dino Vault</div>
            </a>

            <nav class="flex items-center gap-x-8">
                @auth
                    <form action="/logout" method="POST">
                        @csrf
                        <button class="hover:underline" type="submit">Log out</button>
                    </form>

                    <a href="/users/{{ Auth::user()->id }}/all">
                        <img class="h-12 w-12 rounded-full border-2 border-transparent hover:border-gray-200"
                            src="{{ Auth::user()->avatar }}" alt="">
                    </a>
                @else
                    <a class="hover:underline" href="/login">Log in with Discord</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        {{ $slot }}
    </main>
</body>

</html>
