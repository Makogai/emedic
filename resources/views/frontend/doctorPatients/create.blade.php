@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.doctorPatient.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.doctor-patients.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="patient_id">{{ trans('cruds.doctorPatient.fields.patient') }}</label>
                            <select class="form-control select2" name="patient_id" id="patient_id">
                                @foreach($patients as $id => $entry)
                                    <option value="{{ $id }}" {{ old('patient_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('patient'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('patient') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.doctorPatient.fields.patient_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="doctor_id">{{ trans('cruds.doctorPatient.fields.doctor') }}</label>
                            <select class="form-control select2" name="doctor_id" id="doctor_id" required>
                                @foreach($doctors as $id => $entry)
                                    <option value="{{ $id }}" {{ old('doctor_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('doctor'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('doctor') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.doctorPatient.fields.doctor_helper') }}</span>
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