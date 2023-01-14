@extends('layouts.app')
@section('content')
<style>
    .login_input {
        border: 0;
        border-bottom: 1px solid gray;
        border-radius: 0;

    }

    .butt-bg {
        background-color: #4F9D92 !important;
        border: 0;
    }

    body {
        border: 0;
        background-color: white !important;
    }

    .card {
        border: 0 !important;
    }
</style>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class=" ">
            <div class="card-body p-4">
                <img src="/images/logo.png" alt="" class="mx-auto d-block w-50">
                <h1 class="font-bold text-center text-3xl">RESETUJ</h1>
                <h3 class="text-center mb-8">LOZINKU</h3>



                @if(session('message'))
                <div class="alert alert-info" role="alert">
                    {{ session('message') }}
                </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-3">
                        <h4>Email</h4>

                        <input id="email" type="email" class="login_input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email') }}">

                        @if($errors->has('email'))
                        <span class="text-danger">
                            {{ $errors->first('email') }}
                        </span>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn butt-bg btn-primary px-4">
                                RESETUJ
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>




@endsection