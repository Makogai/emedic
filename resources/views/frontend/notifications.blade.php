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
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row justify-content-center heding mb-2">
                    <p class="">
                        Notifikacije
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p>
                    Neotvorene ({{ auth()->user()->unread_notifications['count'] }}):
                </p>
            </div>
        </div>
        @foreach(auth()->user()->unread_notifications['notifications'] as $noti)
            {{--            {{ dd($noti) }}--}}
            <a href="{{ $noti->url }}" class="bland">
            <div class="row notif">
                <div class="blabla ">
                    {{ $noti->created_at->diffForHumans() }}
                </div>
                <div class="col-3 d-flex mx-auto pt-2 pr-0 pl-4 content-align-center align-items-center ">
                    <img src="{{ $noti->icon }}" alt="" class="w-75">
                </div>
                <div class="col-9 justify-content-center d-flex flex-column p-0 test1">
                    <p class="hed">
                        @php
                            $title = '';
                            $desc = '';
                            switch($noti->table){
                                case 'medications':
                                    $title = $noti->drug->name;
                                    $desc = "Dr. ". $noti->doctor->name. " vam je propisao novi lijek";
                                    break;
                                case 'tests':
                                    $title = $noti->title;
                                    $desc = "Dr. ". $noti->doctor->name. " je postavio novi test";
                                    break;
                                default:
                                    $title = $noti->title;
                                    $desc = "Dr. ". $noti->doctor->name. " je postavio novi izvjestaj/misljenje";
                            }
                        @endphp
                        {{ $title  }}
                    </p>
                    <span class="">
                       {{ $desc }}
                </span>
                </div>
            </div>
            </a>
        @endforeach
        <div class="row mb-3 mt-5">
            <div class="col-12">
                <p>
                    Otvorene:
                </p>
            </div>
        </div>

        @foreach(auth()->user()->read_notifications['notifications'] as $noti)
            {{--            {{ dd($noti) }}--}}
            <a href="{{ $noti->url }}" class="bland">
                <div class="row read">
                    <div class="blabla ">
                        {{ $noti->created_at->diffForHumans() }}
                    </div>
                    <div class="col-3 d-flex mx-auto pt-2 pr-0 pl-4 content-align-center align-items-center ">
                        <img src="{{ $noti->icon }}" alt="" class="w-75">
                    </div>
                    <div class="col-9 justify-content-center d-flex flex-column p-0 test1">
                        <p class="hed">
                            @php
                                $title = '';
                                $desc = '';
                                switch($noti->table){
                                    case 'medications':
                                        $title = $noti->drug->name;
                                        $desc = "Dr. ". $noti->doctor->name. " vam je propisao novi lijek";
                                        break;
                                    case 'tests':
                                        $title = $noti->title;
                                        $desc = "Dr. ". $noti->doctor->name. " je postavio novi test";
                                        break;
                                    default:
                                        $title = $noti->title;
                                        $desc = "Dr. ". $noti->doctor->name. " je postavio novi izvjestaj/misljenje";
                                }
                            @endphp
                            {{ $title  }}
                        </p>
                        <span class="">
                       {{ $desc }}
                </span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection
