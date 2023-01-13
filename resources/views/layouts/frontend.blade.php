<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <style>
        #loading {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 100000;
            width: 100vw;
            height: 100vh;
            background-color: rgb(255, 255, 255);
            display: grid;
            place-items: center;
        }
        @media screen and (orientation: landscape) {
            #app { display: none; }
            .use-portrait { display: block; }
        }
        .use-portrait {
            -webkit-transform: rotate(90deg);
            transform: rotate(90deg);
        }
    </style>

    <script>
        function onReady(callback) {
            var intervalId = window.setInterval(function() {
                if (document.getElementsByTagName('body')[0] !== undefined) {
                    window.clearInterval(intervalId);
                    callback.call(this);
                }
            }, 250);
        }

        function setVisible(selector, visible) {
            document.querySelector(selector).style.display = visible ? 'block' : 'none';
        }

        onReady(function() {
            setVisible('#app', true);
            setVisible('#loading', false);
        });
    </script>
    @yield('styles')
    <style>
        .butt{
            border: 0 !important;
            padding: 0 !important;
        }
    </style>
    @laravelPWA
</head>

<body>
<div id="loading">
    <div class="d-flex flex-column">
        <img class="w-25 mx-auto mb-5" src="{{asset('images/logo.png')}}" alt="">
        <img class="w-25 loaderimg mx-auto" src="{{asset('images/loader.svg')}}" alt="">
    </div>

</div>
<div class="d-none d-md-flex flex-column align-items-center mt-5">
{{--    <img src="{{asset('images/warning.png')}}" class="" alt="">--}}
    <img src="{{asset('images/rotate.png')}}" class="" alt="">
    <h1>Aplikacija nije dostupna u landscape modu</h1>
    <h3>Molimo vas koristite mobilni telefon uspravno</h3>
</div>
<div id="app" class="d-block d-md-none">
    {{--        <nav class="navbar navbar-expand-md navbar-light bg-white p-4">--}}
    {{--            <div class="container">--}}

    {{--                <button class="navbar-toggler butt" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
    {{--                    <img src="/images/hamb.png" alt="">--}}
    {{--                </button>--}}

    {{--                <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
    {{--                    <!-- Left Side Of Navbar -->--}}
    {{--                    <ul class="navbar-nav mr-auto">--}}
    {{--                        @guest--}}
    {{--                        @else--}}
    {{--                            <li class="nav-item">--}}
    {{--                                <a class="nav-link {{ request()->is("frontend/profile") ? "active" : "" }}" href="{{ route('frontend.profile.index') }}">--}}
    {{--                                    {{ __('Moj Profil') }}--}}
    {{--                                </a>--}}
    {{--                            </li>--}}

    {{--                            <li class="nav-item">--}}
    {{--                                <a class="nav-link  {{ request()->is("reports") ? "active" : "" }}" href="{{ route('frontend.reports.index') }}">--}}
    {{--                                    {{ __('Izvestaji') }}--}}
    {{--                                </a>--}}
    {{--                            </li>--}}

    {{--                            <li class="nav-item {{ request()->is("medications") ? "active" : "" }}">--}}
    {{--                                <a class="nav-link" href="{{ route('frontend.medications.index') }}">--}}
    {{--                                    {{ __('Lekovi') }}--}}
    {{--                                </a>--}}
    {{--                            </li>--}}

    {{--                            <li class="nav-item {{ request()->is("tests") ? "active" : "" }}">--}}
    {{--                                <a class="nav-link" href="{{ route('frontend.tests.index') }}">--}}
    {{--                                    {{ __('Testovi') }}--}}
    {{--                                </a>--}}
    {{--                            </li>--}}
    {{--                        @endguest--}}
    {{--                    </ul>--}}

    {{--                    <!-- Right Side Of Navbar -->--}}
    {{--                    <ul class="navbar-nav ml-auto">--}}
    {{--                        <!-- Authentication Links -->--}}
    {{--                        @guest--}}
    {{--                            <li class="nav-item">--}}
    {{--                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
    {{--                            </li>--}}
    {{--                            @if(Route::has('register'))--}}
    {{--                                <li class="nav-item">--}}
    {{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
    {{--                                </li>--}}
    {{--                            @endif--}}
    {{--                        @else--}}
    {{--                            <li class="nav-item dropdown">--}}
    {{--                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
    {{--                                    {{ Auth::user()->name }} <span class="caret"></span>--}}
    {{--                                </a>--}}

    {{--                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}

    {{--                                    <a class="dropdown-item" href="{{ route('frontend.profile.index') }}">{{ __('My profile') }}</a>--}}


    {{--                                    @can('report_access')--}}
    {{--                                        <a class="dropdown-item" href="{{ route('frontend.reports.index') }}">--}}
    {{--                                            {{ trans('cruds.report.title') }}--}}
    {{--                                        </a>--}}
    {{--                                    @endcan--}}
    {{--                                    @can('medication_access')--}}
    {{--                                        <a class="dropdown-item" href="{{ route('frontend.medications.index') }}">--}}
    {{--                                            {{ trans('cruds.medication.title') }}--}}
    {{--                                        </a>--}}
    {{--                                    @endcan--}}
    {{--                                    @can('test_access')--}}
    {{--                                        <a class="dropdown-item" href="{{ route('frontend.tests.index') }}">--}}
    {{--                                            {{ trans('cruds.test.title') }}--}}
    {{--                                        </a>--}}
    {{--                                    @endcan--}}

    {{--                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();--}}
    {{--                                                     document.getElementById('logout-form').submit();">--}}
    {{--                                        {{ __('Logout') }}--}}
    {{--                                    </a>--}}

    {{--                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
    {{--                                        @csrf--}}
    {{--                                    </form>--}}
    {{--                                </div>--}}
    {{--                            </li>--}}
    {{--                        @endguest--}}
    {{--                    </ul>--}}
    {{--                </div>--}}

    {{--            </div>--}}
    {{--        </nav>--}}
    <style>
        .mobile-nav {
            background: #F1F1F1;
            position: fixed;
            bottom: 0;
            height: 65px;
            width: 100%;
            display: flex;
            justify-content: space-around;
            z-index: 10000;
        }
        .bloc-icon {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .bloc-icon img {
            width: 30px;
        }
    </style>

    <nav class="mobile-nav">
        <a href="{{ route('frontend.profile.index') }}" class="bloc-icon">
            <img src="{{asset('images/user.png')}}" alt="">
        </a>
        <a href="{{ route('frontend.reports.index') }}" class="bloc-icon">
            <img src="{{asset('images/docs.png')}}" alt="">
        </a>
        <a href="{{ route('frontend.medications.index') }}" class="bloc-icon">
            <img src="{{asset('images/meds.png')}}" alt="">
        </a>
        <a href="{{ route('frontend.tests.index') }}" class="bloc-icon">
            <img src="{{asset('images/icon1.png')}}" alt="">
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
            @csrf
        </form>
        <a href="" onclick="event.preventDefault();document.getElementById('logout-form').submit(); "class="bloc-icon">
            <img src="{{asset('images/hamb.png')}}" alt="">
        </a>
    </nav>

    <main class="py-4">
        @if(session('message'))
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                    </div>
                </div>
            </div>
        @endif
        @if($errors->count() > 0)
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <ul class="list-unstyled mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @yield('content')
    </main>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
@yield('scripts')

</html>
