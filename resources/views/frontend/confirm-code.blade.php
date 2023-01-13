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
        <div class="col-md-6 mt-5">
            <div class=" ">
                <div class="card-body p-4">
                    <img src="/images/logo.png" alt="" class="mx-auto d-block w-50">
                    <h1 class="font-bold text-center text-3xl">AKTIVACIJA</h1>
                    <h3 class="text-center mb-5">NALOGA</h3>



                    @if(session('message'))
                        <div class="alert alert-info" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form action="{{route('code.confirmCode')}}" method="POST">
                        @csrf

                        <div class="mb-3 ">
                            <h4>Kod</h4>

                            <input id="code" name="code" type="text" class="login_input form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" required placeholder="#12345"  value="{{ old('code', null) }}">

                            @if($errors->has('code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('code') }}
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn butt-bg btn-primary px-4">
                                    AKTIVIRAJ
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
