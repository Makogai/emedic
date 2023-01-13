@extends('layouts.app')
@section('content')
    <style>
        .login_input{
            border:0;
            border-bottom: 1px solid gray;
            border-radius: 0;

        }
        .butt-bg{
            background-color: #4F9D92 !important;
            border:0;
        }
        body{
            border: 0;
            background-color: white !important;
        }
        .card{
            border:0 !important;
        }
    </style>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card ">
                <div class="card-body p-4">
                    <img src="/images/logo.png" alt="" class="mx-auto d-block w-50">
                    <h1 class="font-bold text-center text-3xl">PRIJAVA</h1>
                    <h3 class="text-center mb-8">KORISNIKA</h3>



                    @if(session('message'))
                        <div class="alert alert-info" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <h4>Email</h4>

                            <input id="email" name="email" type="text" class="login_input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="marko.markovic@gmail.com" value="{{ old('email', null) }}">

                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <h4>Password</h4>
                            <input id="password" name="password" type="password" class="login_input form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">

                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>

                        <div class="input-group mb-4">
                            <div class="form-check checkbox">
                                <input class="form-check-input" name="remember" type="checkbox" id="remember" style="vertical-align: middle;" />
                                <label class="form-check-label" for="remember" style="vertical-align: middle;">
                                    Zapamti moje podatke
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn butt-bg btn-primary px-4">
                                    PRIJAVI SE
                                </button>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 text-left">
                                <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                   Zaboravili ste lozinku?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
