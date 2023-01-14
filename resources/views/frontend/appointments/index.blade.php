@extends('layouts.frontend')
@section('content')
    @section('styles')
        <script src="{{asset('fc/dist/index.global.js')}}"></script>

        <script>

            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    height: 500,
                    events: '/calendar',
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
    <style>
        .heding {
            font-size: 25px;

        }
        .fc .fc-toolbar-title{
            font-size: 20px;
        }
        .fc .fc-button {
            line-height: 1!important;
            /*height: 30px!important;*/
            padding: 4px 10px;
        }
    </style>
<div class="container-fluid">
    <div class="row justify-content-center ">
        <div class="row justify-content-center mb-5">
            <div class="col-12">
                <div class="row justify-content-center heding ">
                    <p class="">
                        Zakazani pregledi
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div id='calendar'></div>
</div>

