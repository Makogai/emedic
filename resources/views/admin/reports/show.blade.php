@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.report.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reports.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.id') }}
                        </th>
                        <td>
                            {{ $report->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.title') }}
                        </th>
                        <td>
                            {{ $report->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.content') }}
                        </th>
                        <td>
                            {!! $report->content !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.file') }}
                        </th>
                        <td>
                            @foreach($report->file as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.date') }}
                        </th>
                        <td>
                            {{ $report->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.doctor') }}
                        </th>
                        <td>
                            {{ $report->doctor->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.patient') }}
                        </th>
                        <td>
                            {{ $report->patient->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.report.fields.isread') }}
                        </th>
                        <td>
                            {{ App\Models\Report::ISREAD_RADIO[$report->isread] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reports.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection