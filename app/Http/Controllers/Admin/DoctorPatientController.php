<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDoctorPatientRequest;
use App\Http\Requests\StoreDoctorPatientRequest;
use App\Http\Requests\UpdateDoctorPatientRequest;
use App\Models\DoctorPatient;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DoctorPatientController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('doctor_patient_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctorPatients = DoctorPatient::with(['patient', 'doctor'])->get();

        return view('admin.doctorPatients.index', compact('doctorPatients'));
    }

    public function create()
    {
        abort_if(Gate::denies('doctor_patient_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = User::patients()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        // Get users with role id 3 (doctor)
        $doctors = User::medics()
            ->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');


        return view('admin.doctorPatients.create', compact('doctors', 'patients'));
    }

    public function store(StoreDoctorPatientRequest $request)
    {
        $doctorPatient = DoctorPatient::create($request->all());

        return redirect()->route('admin.doctor-patients.index');
    }

    public function edit(DoctorPatient $doctorPatient)
    {
        abort_if(Gate::denies('doctor_patient_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctors = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctorPatient->load('patient', 'doctor');

        return view('admin.doctorPatients.edit', compact('doctorPatient', 'doctors', 'patients'));
    }

    public function update(UpdateDoctorPatientRequest $request, DoctorPatient $doctorPatient)
    {
        $doctorPatient->update($request->all());

        return redirect()->route('admin.doctor-patients.index');
    }

    public function show(DoctorPatient $doctorPatient)
    {
        abort_if(Gate::denies('doctor_patient_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctorPatient->load('patient', 'doctor');

        return view('admin.doctorPatients.show', compact('doctorPatient'));
    }

    public function destroy(DoctorPatient $doctorPatient)
    {
        abort_if(Gate::denies('doctor_patient_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctorPatient->delete();

        return back();
    }

    public function massDestroy(MassDestroyDoctorPatientRequest $request)
    {
        DoctorPatient::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
