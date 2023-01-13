@extends('layouts.frontend')
@section('styles')
    <script src="{{asset('fc/dist/index.global.js')}}"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridFourDay',
                events: '/calendar',
                height: 180,
                views: {
                    dayGridFourDay: {
                        type: 'dayGrid',
                        duration: { days: 4 },
                        buttonText: '4 day'
                    }
                }
            });
            calendar.render();


        });

        //wait 100 ms
        setTimeout(function() {
            //then scroll to the element with the id of 'calendar'
            document.querySelector('.fc-next-button').addEventListener('click', function() {
                ah();
            });
        }, 1000);


        function ah(){
            let a = document.querySelector('.fc-event-title');
            a.insertBefore(document.createElement('br'), null);
        }


    </script>
@endsection
@section('content')
    <style>
        .siz{
            font-size: 26px;
        }
        .imaa{
            height:58px;
            width: 58px;
        }
        .hed{
            font-weight: bold;
            margin:0;
        }
        .butn{
            width: 150px;
            height: 120px;
            background: rgb(34,132,117);
            background: linear-gradient(0deg, rgba(34,132,117,0.13489145658263302) 0%, rgba(255,255,255,1) 100%);
            padding-bottom: 25px;
            text-align: center;
            border:0;
            border-radius: 10px;
            font-size: 16px;
            color: black;

        }
        .card{
            border: 0;
        }
        .test1{
            width: 100%;
        }
        .notif{

            height: 130px;
            background: rgb(255,255,255);
            background: linear-gradient(180deg, rgba(255,255,255,0.13489145658263302) 0%, rgba(255,255,255,0.23573179271708689) 55%, rgba(143,205,196,0.4066001400560224) 100%);
            position: relative;
        }
        .read{
            height: 130px;
            position:relative;
            background:#F2F5F5;
        }
        .proba{
            font-weight: bold;
            margin:0;
            opacity: 0.7;
        }
        .reead{
            margin:0;
            opacity: 0.7;
        }
        .reead-icon{
            opacity: 0.7;
        }
        .blabla{
            position: absolute;
            top:0;
            right: 0;
            font-size: 12px;

        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="row">
                        <div class="col-4 pl-4 pr-0">
                            <img src="/images/profile.png" alt="" class="">
                        </div>
                        <div class="col-8 pl-4 align-items-center d-flex p-0 ">
                            <p class="siz">{{auth()->user()->name}}</p>

                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <p class="hed">Zakazani pregledi</p>

                        </div>
                        <div class="row mb-3">
                            <div class="col-12 p-0">
                                <div id='calendar'></div>
{{--                                <img src="/images/test.png" alt="" class="test1">--}}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4 gap-4">

                        <div class="col-6 d-flex mx-auto content-align-center p-0">
                            <a href="" class="butn d-block mx-auto">
                                <img src="/images/icon1.png" alt=""><br>
                                Izvestaj i misljenje ljekara

                            </a>
                        </div>
                        <div class="col-6 align-items-center content-align-center p-0">
                            <button class="butn d-block mx-auto">
                                <img src="/images/docic.png" alt=""><br>
                                Nalazi i odrađeni testovi
                            </button>
                        </div>

                    </div>
                    <div class="row gap-4">

                        <div class="col-6 d-flex mx-auto content-align-center p-0">
                            <a href="{{route('frontend.docs')}}" class="butn d-block mx-auto">
                                <img src="/images/docs.png" alt=""><br>
                                ILjekari pacijenta
                            </a>
                        </div>
                        <div class="col-6 align-items-center content-align-center p-0">
                            <button class="butn d-block mx-auto">
                                <img src="/images/meds.png" alt=""><br>
                                Izvestaj i misljenje ljekara
                            </button>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
