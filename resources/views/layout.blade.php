<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hackernews</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
</head>

<body>
    <header>
        <nav>
            <p class="logo">Hackernews</p>
            <ul class="registerNav">
                @guest
                @if (Route::has('login'))
                <li class="">
                    <a class="" href="{{ route('login') }}">{{ __('Sign in') }}</a>
                </li>
                @endif

                <div class="separator"></div>

                @if (Route::has('register'))
                <li class="">
                    <a class="" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif

                @else
                <li>
                    <div class="userContainer">
                        <a class="" href="{{ route('user.settings') }}" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="separator"></div>

                        <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>

                    </div>
                </li>
                @endguest

            </ul>
        </nav>
    </header>
    @yield("content")
</body>

</html>