<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hackernews</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="/css/app.css">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>

        // Making user data accessible to vue by adding them to the global window object
        window.hackernews = {
            url: '{{ 'config(app.url)' }}',
            user: {
                id: {{ Auth::check() ? Auth::user()->id : 'null' }},
                authenticated: {{ Auth::check() ? 'true' : 'false' }}
            }
        }
    </script>
</head>

<body>
    <header>
        <nav>
            <a href="{{route('welcome')}}">
                <p class="logo">Hackernews</p>
            </a>
            <!-- <section class="posts"> -->

            <ul>
                <li><a href="{{route('popular')}}">Popular</a></li>
                <li><a href="{{route('welcome')}}">Newest</a></li>
            </ul>


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
                        <a class="" href="{{ route('settings') }}" v-pre>
                            {{ Auth::user()->name }}
                        </a>

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
            <!-- </section> -->
        </nav>
    </header>
    <main class="content">
        @yield("content")
    </main>
    <script src="/js/app.js"></script>
</body>

</html>
