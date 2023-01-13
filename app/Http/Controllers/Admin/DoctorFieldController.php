<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDoctorFieldRequest;
use App\Http\Requests\StoreDoctorFieldRequest;
use App\Http\Requests\UpdateDoctorFieldRequest;
use App\Models\DoctorField;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DoctorFieldController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('doctor_field_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctorFields = DoctorField::all();

        return view('admin.doctorFields.index', compact('doctorFields'));
    }

    public function create()
    {
        abort_if(Gate::denies('doctor_field_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.doctorFields.create');
    }

    public function store(StoreDoctorFieldRequest $request)
    {
        $doctorField = DoctorField::create($request->all());

        return redirect()->route('admin.doctor-fields.index');
    }

    public function edit(DoctorField $doctorField)
    {
        abort_if(Gate::denies('doctor_field_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.doctorFields.edit', compact('doctorField'));
    }

    public function update(UpdateDoctorFieldRequest $request, DoctorField $doctorField)
    {
        $doctorField->update($request->all());

        return redirect()->route('admin.doctor-fields.index');
    }

    public function show(DoctorField $doctorField)
    {
        abort_if(Gate::denies('doctor_field_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctorField->load('sectorUsers');

        return view('admin.doctorFields.show', compact('doctorField'));
    }

    public function destroy(DoctorField $doctorField)
    {
        abort_if(Gate::denies('doctor_field_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctorField->delete();

        return back();
    }

    public function massDestroy(MassDestroyDoctorFieldRequest $request)
    {
        DoctorField::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
