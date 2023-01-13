@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.verified') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->verified ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.image') }}
                        </th>
                        <td>
                            @if($user->image)
                                <a href="{{ $user->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $user->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.registration_code') }}
                        </th>
                        <td>
                            {{ $user->registration_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.bio') }}
                        </th>
                        <td>
                            {!! $user->bio !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.sector') }}
                        </th>
                        <td>
                            {{ $user->sector->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $user->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.jmbg') }}
                        </th>
                        <td>
                            {{ $user->jmbg }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#patient_doctor_patients" role="tab" data-toggle="tab">
                {{ trans('cruds.doctorPatient.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#doctor_doctor_patients" role="tab" data-toggle="tab">
                {{ trans('cruds.doctorPatient.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#doctor_reports" role="tab" data-toggle="tab">
                {{ trans('cruds.report.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#patient_reports" role="tab" data-toggle="tab">
                {{ trans('cruds.report.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#doctor_medications" role="tab" data-toggle="tab">
                {{ trans('cruds.medication.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#patient_medications" role="tab" data-toggle="tab">
                {{ trans('cruds.medication.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#doctor_tests" role="tab" data-toggle="tab">
                {{ trans('cruds.test.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#patient_tests" role="tab" data-toggle="tab">
                {{ trans('cruds.test.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#doctor_appointments" role="tab" data-toggle="tab">
                {{ trans('cruds.appointment.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#patient_appointments" role="tab" data-toggle="tab">
                {{ trans('cruds.appointment.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_alerts" role="tab" data-toggle="tab">
                {{ trans('cruds.userAlert.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="patient_doctor_patients">
            @includeIf('admin.users.relationships.patientDoctorPatients', ['doctorPatients' => $user->patientDoctorPatients])
        </div>
        <div class="tab-pane" role="tabpanel" id="doctor_doctor_patients">
            @includeIf('admin.users.relationships.doctorDoctorPatients', ['doctorPatients' => $user->doctorDoctorPatients])
        </div>
        <div class="tab-pane" role="tabpanel" id="doctor_reports">
            @includeIf('admin.users.relationships.doctorReports', ['reports' => $user->doctorReports])
        </div>
        <div class="tab-pane" role="tabpanel" id="patient_reports">
            @includeIf('admin.users.relationships.patientReports', ['reports' => $user->patientReports])
        </div>
        <div class="tab-pane" role="tabpanel" id="doctor_medications">
            @includeIf('admin.users.relationships.doctorMedications', ['medications' => $user->doctorMedications])
        </div>
        <div class="tab-pane" role="tabpanel" id="patient_medications">
            @includeIf('admin.users.relationships.patientMedications', ['medications' => $user->patientMedications])
        </div>
        <div class="tab-pane" role="tabpanel" id="doctor_tests">
            @includeIf('admin.users.relationships.doctorTests', ['tests' => $user->doctorTests])
        </div>
        <div class="tab-pane" role="tabpanel" id="patient_tests">
            @includeIf('admin.users.relationships.patientTests', ['tests' => $user->patientTests])
        </div>
        <div class="tab-pane" role="tabpanel" id="doctor_appointments">
            @includeIf('admin.users.relationships.doctorAppointments', ['appointments' => $user->doctorAppointments])
        </div>
        <div class="tab-pane" role="tabpanel" id="patient_appointments">
            @includeIf('admin.users.relationships.patientAppointments', ['appointments' => $user->patientAppointments])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_alerts">
            @includeIf('admin.users.relationships.userUserAlerts', ['userAlerts' => $user->userUserAlerts])
        </div>
    </div>
</div>

@endsection