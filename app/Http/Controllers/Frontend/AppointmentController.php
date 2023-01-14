<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAppointmentRequest;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppointmentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointments = Appointment::with(['doctor', 'patient'])->get();

        return view('frontend.appointments.index', compact('appointments'));
    }

    public function create()
    {
        abort_if(Gate::denies('appointment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctors = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $patients = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.appointments.create', compact('doctors', 'patients'));
    }

    public function store(StoreAppointmentRequest $request)
    {
        $request['patient_id'] = auth()->user()->id;

        $appointment = Appointment::create($request->all());

        return redirect()->route('frontend.appointments.index');
    }

    public function edit(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctors = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $patients = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $appointment->load('doctor', 'patient');

        return view('frontend.appointments.edit', compact('appointment', 'doctors', 'patients'));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update($request->all());

        return redirect()->route('frontend.appointments.index');
    }

    public function show(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->load('doctor', 'patient');

        return view('frontend.appointments.show', compact('appointment'));
    }

    public function destroy(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppointmentRequest $request)
    {
        Appointment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
