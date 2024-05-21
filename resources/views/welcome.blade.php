<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome</title>
</head>

<body>
    <nav>
        @auth
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
</body>

</html>
