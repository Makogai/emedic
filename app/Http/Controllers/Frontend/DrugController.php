<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDrugRequest;
use App\Http\Requests\StoreDrugRequest;
use App\Http\Requests\UpdateDrugRequest;
use App\Models\Drug;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DrugController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('drug_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drugs = Drug::with(['media'])->get();

        return view('frontend.drugs.index', compact('drugs'));
    }

    public function create()
    {
        abort_if(Gate::denies('drug_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.drugs.create');
    }

    public function store(StoreDrugRequest $request)
    {
        $drug = Drug::create($request->all());

        if ($request->input('image', false)) {
            $drug->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $drug->id]);
        }

        return redirect()->route('frontend.drugs.index');
    }

    public function edit(Drug $drug)
    {
        abort_if(Gate::denies('drug_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.drugs.edit', compact('drug'));
    }

    public function update(UpdateDrugRequest $request, Drug $drug)
    {
        $drug->update($request->all());

        if ($request->input('image', false)) {
            if (!$drug->image || $request->input('image') !== $drug->image->file_name) {
                if ($drug->image) {
                    $drug->image->delete();
                }
                $drug->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($drug->image) {
            $drug->image->delete();
        }

        return redirect()->route('frontend.drugs.index');
    }

    public function show(Drug $drug)
    {
        abort_if(Gate::denies('drug_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.drugs.show', compact('drug'));
    }

    public function destroy(Drug $drug)
    {
        abort_if(Gate::denies('drug_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $drug->delete();

        return back();
    }

    public function massDestroy(MassDestroyDrugRequest $request)
    {
        Drug::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('drug_create') && Gate::denies('drug_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Drug();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
