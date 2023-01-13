@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.medication.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.medications.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.medication.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $medication->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.medication.fields.purpose') }}
                                    </th>
                                    <td>
                                        {!! $medication->purpose !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.medication.fields.usage') }}
                                    </th>
                                    <td>
                                        {!! $medication->usage !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.medication.fields.doctor') }}
                                    </th>
                                    <td>
                                        {{ $medication->doctor->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.medication.fields.patient') }}
                                    </th>
                                    <td>
                                        {{ $medication->patient->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.medication.fields.isread') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Medication::ISREAD_RADIO[$medication->isread] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.medication.fields.drug') }}
                                    </th>
                                    <td>
                                        @foreach($medication->drugs as $key => $drug)
                                            <span class="label label-info">{{ $drug->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.medications.index') }}">
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