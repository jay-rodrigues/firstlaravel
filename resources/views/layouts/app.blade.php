<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item dropdown">

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Project 1
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/displayusers">Display Users</a>
                                <a class="dropdown-item" href="/posts">View Posts</a>
                                <a class="dropdown-item" href="/posts/create">New Post</a>



                            </div>
                        </li>
                        <li class="nav-item dropdown">

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Encryption Tools
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/key">Key Generator</a>
                                <a class="dropdown-item" href="/caesarcipher">Caesar Cipher</a>

                                {{-- <a class="dropdown-item" href="/posts">View Posts</a>
                                <a class="dropdown-item" href="/posts/create">New Post</a> --}}



                            </div>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script>
        //grabs int from webpage
        function generateKey(){
            let length = document.getElementById("length").value;

            axios.get(`/generate/${length}`)
                .then(function(response){
                    console.log(response.data);
                    addKeyToDOM(response.data);
                })
                .catch(function(error){
                    console.log(error.response.data);
                });
        }

        //function to display key
        function addKeyToDOM(key){
            let tablebody = document.getElementById("table-body");
            console.log(tablebody);
            let row = document.createElement("tr");
            let content = document.createElement("th");

            content.innerHTML = key;
            row.appendChild(content);
            tablebody.appendChild(row);
        }

        function encipherString(){
            let plainText = document.getElementById("input-string").value;
            let key = document.getElementById("input-key").value;
            axios.get(`/caesarencipher/${plainText}/${key}`)
                .then(function(response){
                    console.log(response.data);
                    addKeyToDOM(response.data);
                })
                .catch(function(error){
                    console.log(error.response.data);
                });
        }
        function decipherString(){
            let plainText = document.getElementById("input-string").value;
            let key = document.getElementById("input-key").value;
            axios.get(`/caesardecipher/${plainText}/${key}`)
                .then(function(response){
                    console.log(response.data);
                    addKeyToDOM(response.data);
                })
                .catch(function(error){
                    console.log(error.response.data);
                });
        }


    </script>
</body>
</html>
