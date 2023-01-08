<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMedicationRequest;
use App\Http\Requests\StoreMedicationRequest;
use App\Http\Requests\UpdateMedicationRequest;
use App\Models\Medication;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MedicationsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('medication_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medications = Medication::with(['doctor', 'patient'])->get();

        return view('admin.medications.index', compact('medications'));
    }

    public function create()
    {
        abort_if(Gate::denies('medication_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctors = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $patients = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.medications.create', compact('doctors', 'patients'));
    }

    public function store(StoreMedicationRequest $request)
    {
        $medication = Medication::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $medication->id]);
        }

        return redirect()->route('admin.medications.index');
    }

    public function edit(Medication $medication)
    {
        abort_if(Gate::denies('medication_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctors = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $patients = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $medication->load('doctor', 'patient');

        return view('admin.medications.edit', compact('doctors', 'medication', 'patients'));
    }

    public function update(UpdateMedicationRequest $request, Medication $medication)
    {
        $medication->update($request->all());

        return redirect()->route('admin.medications.index');
    }

    public function show(Medication $medication)
    {
        abort_if(Gate::denies('medication_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medication->load('doctor', 'patient');

        return view('admin.medications.show', compact('medication'));
    }

    public function destroy(Medication $medication)
    {
        abort_if(Gate::denies('medication_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medication->delete();

        return back();
    }

    public function massDestroy(MassDestroyMedicationRequest $request)
    {
        Medication::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('medication_create') && Gate::denies('medication_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Medication();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
