@props(['container' => true])
@php
    $container = strtolower($container) === 'false' ? false : true;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Website</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-6.0.0-web/css/all.min.css') }}" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="{{ asset('assets/mdb5/css/mdb.min.css') }}" />
    <style>
        #content {
            /* Margin to fix overlapping fixed navbar */
            margin-top: 60px;
        }
    </style>
</head>

<body class="antialiased">

    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <!-- Container wrapper -->
            <div class="container">
                <!-- Navbar brand -->
                <a class="navbar-brand" href="/">Blogs</a>
                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                    data-mdb-target="#navbarButtonsExample" aria-controls="navbarButtonsExample" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Collapsible wrapper -->
                <div class="collapse navbar-collapse" id="navbarButtonsExample">
                    <!-- Left links -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="/posts/create">Add Post</a>
                            </li>
                        @endauth
                    </ul>
                    <!-- Left links -->

                    <div class="d-flex align-items-center">
                        @auth
                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary px-3 me-2">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="/login">
                                <button type="button" class="btn btn-link px-3 me-2">
                                    Login
                                </button>
                            </a>
                            <a href="/signup">
                                <button type="button" class="btn btn-primary me-3">
                                    Signup
                                </button>
                            </a>
                        @endauth
                    </div>
                </div>
                <!-- Collapsible wrapper -->
            </div>
            <!-- Container wrapper -->
        </nav>
    </header>
    @php
        $container;
    @endphp
    <main {{ $attributes->merge(['class' => $container ? 'container' : '']) }} id="content">
        {{ $slot }}
    </main>
    <!-- MDB -->
    @vite('resources/js/app.js')
    <script type="text/javascript" src="{{ asset('assets/mdb5/js/mdb.min.js') }}"></script>
</body>

</html>
