@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.doctorPatient.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.doctor-patients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.doctorPatient.fields.id') }}
                        </th>
                        <td>
                            {{ $doctorPatient->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctorPatient.fields.patient') }}
                        </th>
                        <td>
                            {{ $doctorPatient->patient->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.doctorPatient.fields.doctor') }}
                        </th>
                        <td>
                            {{ $doctorPatient->doctor->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.doctor-patients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection