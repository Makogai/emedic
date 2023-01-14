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
            background: #F2F5F5;
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

        .heding {
            font-size: 25px;

        }

        .bland {
            color: black;
        }

        .bg-gray {
            background: #F2F5F5;
        }

        .bg-gray p {
            padding: 0 !important;
            margin: 0;
        }

        .font-light {
            color: #515151;
        }

        .brg {
            border-right: 12px solid white;
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
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row justify-content-center heding mb-2">
                    <p class="">
                        Nalazi i odrađeni testovi
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h5>
                    Zdravstveno stanje
                </h5>
            </div>
        </div>

        <div class="container">
            <div class="row gap-1">
                <div class="col-6 brg p-2 py-3 bg-gray">
                    <p class="text-center p-0 mb-1"> Krvni pritisak</p>
                    <p class="text-center font-light p-0 mt-1">{{ $health['blood_pressure'] }}</p>
                </div>
                <div class="col-6 p-2 py-3 bg-gray">
                    <p class="text-center p-0 mb-1"> Otkucaji srca</p>
                    <p class="text-center font-light p-0 mt-1">{{ $health['heart_rate'] }}</p>
                </div>
                <div class="col-6 p-2 py-3 brg bg-gray mt-2">
                    <p class="text-center p-0 mb-1"> Nivo kiseonika</p>
                    <p class="text-center font-light p-0 mt-1">{{ $health['oxygen'] }}</p>
                </div>
            </div>

        </div>


        <div class="row mt-4">
            <div class="col-12">
                <h5>
                    Naredni pregled
                </h5>
            </div>
        </div>

        @if($nextTest)
        <div class="container">
            <div class="row">
                <div class="col-12 px-4 py-3 brg bg-gray mt-2">
                    <p><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($nextTest->date)->format('M d, H:i') }}</p>
                    <p class=" p-0 mb-1 mt-1">{{ $nextTest->doctor->name }}</p>
                    <p class=" font-light p-0 mt-1">{{ $nextTest->doctor->sector->title }}</p>
                </div>
            </div>
        </div>
@endif

        <div class="row mt-4">
            <div class="col-12">
                <h5>
                    Odradjeni testovi
                </h5>
            </div>
        </div>

        <div class="container">


            <div class="row">

                @foreach($tests as $test)
                <a href="{{ $test->url }}" style="display: block; width: 100%; color: black">
                    <div class="col-12 px-4 py-3 brg bg-gray mt-2 border-info">
                        <div class="boticon d-grid place-items-center">
                            <img src="/images/boticon.png" alt="">
                        </div>
                        <p><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($test->date)->format('M d, H:i') }}</p>
                        <p class=" p-0 mb-1 mt-1">{{ $test->title }}</p>
                        <p class=" font-light p-0 mt-1">{{ $test->doctor->name }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
