@extends('layouts.frontend')
@section('content')
    <style>
        .siz {
            font-size: 26px;
        }

        .imaa {
            height: 58px;
            width: 58px;
        }

        .hed {
            font-weight: bold;
            margin: 0;
        }

        .butn {
            width: 150px;
            height: 120px;
            background: rgb(34, 132, 117);
            background: linear-gradient(0deg, rgba(34, 132, 117, 0.13489145658263302) 0%, rgba(255, 255, 255, 1) 100%);
            padding-bottom: 25px;
            text-align: center;
            border: 0;
            border-radius: 10px;
            font-size: 16px;

        }

        .card {
            border: 0;
        }

        .test1 {
            width: 100%;
        }

        .notif {

            height: 130px;
            background: rgb(255, 255, 255);
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.13489145658263302) 0%, rgba(255, 255, 255, 0.23573179271708689) 55%, rgba(143, 205, 196, 0.4066001400560224) 100%);
            position: relative;
        }

        .read {
            height: 130px;
            position: relative;

        }

        .proba {
            font-weight: bold;
            margin: 0;
            opacity: 0.7;
        }

        .reead {
            margin: 0;
            opacity: 0.7;
        }

        .reead-icon {
            opacity: 0.7;
        }

        .blabla {
            position: absolute;
            top: 0;
            right: 0;
            font-size: 12px;

        }

        .boticon {
            position: absolute;
            bottom: 0;
            right: 0;
        }

        .heding {
            font-size: 25px;

        }
        .boticon {
            position: absolute;
            top: 50%;
            right: 0;
            transform: translate(-50%, -50%);
            display: grid;
            place-items: center;
        }
        .relative {
            position: relative;
        }
        .text-black {
            color: black;
        }
    </style>
    <div class="container">

        <div class="row">
            <div class="col-12 d-flex flex-column align-items-center">
                @if($user->image)
                    <img src="{{ $user->image->getUrl('thumb') }}" class="w-50">
                @else
                    <img src="{{asset('images/user.png')}}" class="w-50">
                @endif
            </div>
            <div class="col-12">
                <h3 class="text-center mt-3">{{ $user->name }}</h3>
            </div>
            <div class="col-12">
                <h6 class="text-center">{{ $user->doctorField->title }}</h6>
            </div>
            <div class="col-12 text-center">
                <p>Email: {{ $user->email }} Kontakt: {{ $user->phone_number }}</p>
            </div>
            <div class="col-12 d-flex justify-content-center align-items-center">
                <a href="/appoint/{{$user->id}}" class="btn btn-success text-center mx-auto">Zakazi razgovor</a>
            </div>
            <div class="col-12 text-center">
                {!! $user->bio !!}
            </div>
        </div>

    </div>
@endsection
