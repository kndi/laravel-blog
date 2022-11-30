<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Blog Admin - {{ config('app.name', 'Laravel') }}</title>


    <!-- jQuery is only used for hide(), show() and slideDown(). All other features use vanilla JS -->

    <script src="{{ mix('js/app.js') }}"></script>
    <!-- Fonts -->


    <!-- Styles -->

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    {{--    @else --}}
    {{--        <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    {{-- Edited your css/app.css file? Uncomment these lines to use plain bootstrap: --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> --}}
    {{--    @endif --}}


</head>

<style>

    
</style>

<body>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel sticky-top">
            <div class="container-fluid">
                
                <button class="btn float-start sticky-top text-light d-block d-sm-block d-md-none" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" role="button">
                    <i class="bi bi-arrow-right-square fs-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions"></i>
                </button>
                
                <a class="navbar-brand binshops-blog-title" href="{{ route('binshopsblog.admin.index') }}">
                    {{ config('app.name', 'Laravel') }} Blog Dashboard
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->

                        <li class="nav-item"><a class='nav-link'
                                href='{{ route('binshopsblog.index', app('request')->get('locale')) }}'>Blog home</a>
                        </li>

                        <li class="nav-item ">
                            <a id="" class="nav-link " href="#" role="button" aria-haspopup="true"
                                aria-expanded="false">
                                Logged in as {{ Auth::user()->name }}
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row flex-nowrap">
                <div class="col-auto col-md-3 col-xl-2 px-sm-0 px-0 bg-dark min-vh-100">
                    {{--  <button class="btn btn-primary d-block d-sm-block d-md-none" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">Menu</button>  --}}

                    <div class="offcanvas offcanvas-start bg-dark"  style="max-width:240px;"  data-bs-scroll="true" tabindex="-1"
                        id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                        <div class="offcanvas-header border-bottom border-secondary">
                            <h5 class="offcanvas-title text-light" id="offcanvasWithBothOptionsLabel">Menu
                            </h5>
                            <button type="button" class="btn-close text-reset btn-close-white" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body overflow-hidden">
                            @include('binshopsblog_admin::layouts.sidebar')
                        </div>
                    </div>
                    <div
                        class="position-fixed d-flex flex-column align-items-center align-items-xl-start px-3 pt-2 text-white d-none d-md-block sticky-top" style="width:inherit;">

                        @include('binshopsblog_admin::layouts.sidebar')

                    </div>
                </div>
                <div class="col-md-9 py-3 main-content">
                    @if (isset($errors) && count($errors))
                        <div class="alert alert-danger">
                            <b>Sorry, but there was an error:</b>
                            <ul class='m-0'>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    {{-- REPLACING THIS FILE WITH YOUR OWN LAYOUT FILE? Don't forget to include the following section! --}}

                    @if (\BinshopsBlog\Helpers::has_flashed_message())
                        <div class='alert alert-info'>
                            <h3>{{ \BinshopsBlog\Helpers::pull_flashed_message() }}</h3>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
        {{--  
    <main class="py-4">
        <div class="container">
            <div class='row w-100 p-3 nav-bar-full'>
                <div class='list-group-item list-group-item-dark'>
                    
                </div>
                <div class='col-md-9 main-content'>

                </div>
            </div>
        </div>
    </main>  --}}
    </div>

</body>

</html>
