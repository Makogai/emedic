@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.drug.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.drugs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.drug.fields.id') }}
                        </th>
                        <td>
                            {{ $drug->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.drug.fields.name') }}
                        </th>
                        <td>
                            {{ $drug->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.drug.fields.description') }}
                        </th>
                        <td>
                            {!! $drug->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.drug.fields.weight') }}
                        </th>
                        <td>
                            {{ $drug->weight }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.drug.fields.image') }}
                        </th>
                        <td>
                            @if($drug->image)
                                <a href="{{ $drug->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $drug->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.drugs.index') }}">
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
            <a class="nav-link" href="#drug_medications" role="tab" data-toggle="tab">
                {{ trans('cruds.medication.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="drug_medications">
            @includeIf('admin.drugs.relationships.drugMedications', ['medications' => $drug->drugMedications])
        </div>
    </div>
</div>

@endsection