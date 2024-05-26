<x-app-layout>
    <x-slot:header>Dino trading post</x-slot:header>

    <nav>
        @auth
            <form action="/logout" method="POST">
                @csrf
                <button type="submit">Log out</button>
            </form>
            <img src="{{ Auth::user()->avatar }}" alt="">
        @else
            <a href="/login">Log in with Discord</a>
        @endauth
    </nav>

    <main>
        @auth
            <h1>Hello {{ Auth::user()->nickname }}</h1>
        @else
            <h1>Login to see your dinos</h1>
        @endauth
    </main>
</x-app-layout>
