@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.doctorPatient.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.doctor-patients.update", [$doctorPatient->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="patient_id">{{ trans('cruds.doctorPatient.fields.patient') }}</label>
                <select class="form-control select2 {{ $errors->has('patient') ? 'is-invalid' : '' }}" name="patient_id" id="patient_id">
                    @foreach($patients as $id => $entry)
                        <option value="{{ $id }}" {{ (old('patient_id') ? old('patient_id') : $doctorPatient->patient->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <select class="form-control select2 {{ $errors->has('doctor') ? 'is-invalid' : '' }}" name="doctor_id" id="doctor_id" required>
                    @foreach($doctors as $id => $entry)
                        <option value="{{ $id }}" {{ (old('doctor_id') ? old('doctor_id') : $doctorPatient->doctor->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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



@endsection