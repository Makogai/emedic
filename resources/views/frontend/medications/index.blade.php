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

        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row justify-content-center heding mb-2">
                    <p class="">
                        Propisani lekovi
                    </p>
                </div>
            </div>
            @if(count($medications) == 0)
                <div class="col-12">
                    <div class="row justify-content-center">
                        <p class="text-center">
                            Nema propisanih lekova
                        </p>
                    </div>
                </div>
            @endif
            @foreach($medications as $medication)
                <a href="/medications/{{$medication->id}}" class="text-black mt-3 w-100">
                <div class="col relative">
                         <div class="boticon d-grid place-items-center">
                            <img src="/images/boticon.png" alt="">
                        </div>
                    <div class="row border">

                        <div class="col-12">
                            <p class="text-right m-0" style="font-size: 11px">{{ $medication->date }}</p>
                        </div>
                        <div class="col-12 pb-3">
                            <div class="row">
                                <div class="col-4">
                                    @if($medication->drug->image)
                                            <img src="{{ $medication->drug->image->getUrl('thumb') }}" class="w-100">
                                    @else
                                        <img src="{{asset('images/drug-placeholder.jpg')}}" class="w-100">
                                    @endif
                                </div>
                                <div class="col-8">
                                    <p class="proba">{{ $medication->drug->name }}</p>
                                    <span class="reead">
                                        Propisao: {{ $medication->doctor->name }}
                                    </span><br>
                                    <span class="reead">
                                        Datum: {{ $medication->created_at->format('d.m.Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
{{--                <br><br>--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="row read">--}}
{{--                        <div class="blabla pr-2 ">--}}
{{--                            OVDE IDE VREME--}}
{{--                        </div>--}}
{{--                        <div class="col-4 d-flex mx-auto pt-2 content-align-center align-items-center reead-icon ">--}}
{{--                            <img src="/images/droga1.png" alt="" class="">--}}
{{--                        </div>--}}
{{--                        <div class="col-8 justify-content-center pl-4 d-flex flex-column test1">--}}
{{--                            <p class="proba">--}}
{{--                                Izvestaj i misljenje--}}
{{--                            </p>--}}
{{--                            <span class="reead">--}}
{{--                        Propisao: Fiip Smolovic--}}
{{--                        Cijena:5,63$--}}
{{--                    </span>--}}
{{--                        </div>--}}
{{--                        <div class="boticon pr-2">--}}
{{--                            <img src="/images/boticon.png" alt="">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            @endforeach
        </div>

    </div>
@endsection
