@extends('layouts.frontend')
@section('content')
<style>
    .heding {
        font-size: 25px;

    }

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
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row justify-content-center heding mb-2">
                <p>
                    Izvestaj i misljenje ljekara
                </p>
            </div>
            <div class="row">
                <div class="col-12">
                    <p>
                        Neotvorene:
                    </p>
                </div>
            </div>

            <div class="row notif">
                <div class="blabla ">
                    {{ trans('cruds.report.fields.date') }}
                </div>
                <div class="col-3 d-flex mx-auto pt-2 pr-0 pl-4 content-align-center align-items-center ">
                    <img src="/images/docic.png" alt="" class="imaa">
                </div>
                <div class="col-9 justify-content-center d-flex flex-column p-0 test1">
                    <p class="hed">
                        {{ trans('cruds.report.fields.title') }}
                    </p>
                    <span class="">
                        {{ trans('cruds.report.fields.doctor') }}
                    </span>

                </div>
            </div>

            <div class="row mb-3 mt-5">
                <div class="col-12">
                    <p>
                        Otvorene:
                    </p>
                </div>
            </div>

            <div class="row read">
                <div class="blabla ">
                    {{ trans('cruds.report.fields.date') }}
                </div>
                <div class="col-3 d-flex mx-auto pt-2 pr-0 pl-4 content-align-center align-items-center reead-icon ">
                    <img src="/images/docic.png" alt="" class="imaa">
                </div>
                <div class="col-9 justify-content-center d-flex flex-column p-0 test1">
                    <p class="proba">
                        {{ trans('cruds.report.fields.title') }}
                    </p>
                    <span class="reead">
                        {{ trans('cruds.report.fields.doctor') }}
                    </span>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection