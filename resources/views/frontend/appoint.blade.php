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
                <div class="row justify-content-center heding ">
                    <p class="">
                        Zakazivanje razgovora
                    </p>
                </div>
                <p class="text-center">{{ $user->name }}, {{ $user->sector->title }}</p>
            </div>
        </div>



    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">

                    <div class="card-body">
                        <form method="POST" action="{{ route("frontend.appointments.store") }}" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <label class="required" for="date">{{ trans('cruds.appointment.fields.date') }}</label>
                                <input class="form-control datetime" type="text" name="date" id="date" value="{{ old('date') }}" required>
                                @if($errors->has('date'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('date') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.appointment.fields.date_helper') }}</span>
                            </div>

                            <input type="text" name="doctor_id" value="{{$user->id}}" hidden>

                            <div class="form-group">
                                <label class="required" for="purpose">{{ trans('cruds.appointment.fields.purpose') }}</label>
                                <input class="form-control" type="text" name="purpose" id="purpose" value="{{ old('purpose', '') }}" required>
                                @if($errors->has('purpose'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('purpose') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.appointment.fields.purpose_helper') }}</span>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-danger" type="submit">
                                    {{ trans('global.save') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
