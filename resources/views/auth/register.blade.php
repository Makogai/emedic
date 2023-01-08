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
            <h1 class="font-bold text-center text-3xl">REGISTRACIJA</h1>
            <h3 class="text-center ">KORISNIKA</h3>

                <form method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                   
                    <h4 class="text-muted mt-4">Korisnicko ime</h4>

                    <div class="mb-3">
                        
                        <input type="text" name="name" class="login_input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus placeholder="{{ trans('global.user_name') }}" value="{{ old('name', null) }}">
                        @if($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <h4>Email</h4>
                        <input type="email" name="email" class="login_input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <h4>Password</h4>
                        <input type="password" name="password" class="login_input form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">
                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <div class=" mb-5">
                        <h4>Confirm Password</h4>
                        <input type="password" name="password_confirmation" class="form-control login_input" required placeholder="{{ trans('global.login_password_confirmation') }}">
                    </div>

                    <button class="btn btn-block btn-primary butt-bg ">
                        REGISTRUJ SE
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>

@endsection