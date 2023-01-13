@extends('layouts.frontend')
@section('content')
<style>
    .medimg {
        width: 220px;
        height: 145px;
    }

    .medname {
        font-size: 25px;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12">
                    <a class="btn  float-right" href="{{ route('frontend.medications.index') }}">
                        <img src="/images/close.png" alt="">
                    </a>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12 justify-content-center d-flex">
                    <img src="/images/droga2.png" alt="" class="medimg">
                    @if($medication->image)
                    <a href="{{ $medication->image->getUrl() }}" target="_blank" style="display: inline-block">
                        <img src="{{ $medication->image->getUrl('thumb') }}" class="">
                    </a>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p class="medname">
                        {{ $medication->name }}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h4>Indikacije</h4>
                    <p>
                        {!! $medication->purpose !!}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-5">
                    <div data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <h4>
                            Upotreba
                            <img src="/images/open.png" alt="" > 
                        </h4>       
                    </div>                                     
                    <div class="collapse" id="collapseExample">
                        <p> 
                            {!! $medication->usage !!}
                        </p>
                       
                    </div>                    
                </div>

            </div>
            <div class="card mt-5">
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
                                        {{ trans('cruds.medication.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $medication->name }}
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
                                        {{ trans('cruds.medication.fields.image') }}
                                    </th>
                                    <td>

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