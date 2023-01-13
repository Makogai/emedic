@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.drug.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.drugs.index') }}">
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
                            <a class="btn btn-default" href="{{ route('frontend.drugs.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection