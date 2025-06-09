<!doctype html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>User Panel</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"> <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"> --}}

    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"> --}}
    <!-- Custom stlylesheet -->

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 56px;
        }

        .user-content {
            padding: 20px;
        }

        .navbar-brand {
            font-weight: bold;
        }
    </style>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url("/") }}">
                    E-library
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __("Toggle navigation") }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route("student.links") }}">External Links</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route("student.books") }}">Browse Books</a>
                        </li>
                        @auth('student')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('student.payment') }}">Pay Library Fee</a>
                            </li>
                        @endauth

                    </ul>

                    <ul class="navbar-nav ms-auto">
                        {{-- @guest
                        <li>
                            <a href="{{ route('show.login') }}">Admin</a>
                        </li>
                        @endguest --}}

                        @auth('student')

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::guard('student')->user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route("logout") }}"
                                        onclick="event.preventDefault();
                                                                                 document.getElementById('logout-form').submit();">
                                        {{ __("Logout") }}
                                    </a>

                                    <form id="logout-form" action="{{ route("logout") }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @else
                        <a href="{{ route('student.login') }}">login</a>


                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 user-content">
            @yield("content")
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>