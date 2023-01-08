@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.test.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.test.fields.id') }}
                        </th>
                        <td>
                            {{ $test->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.test.fields.title') }}
                        </th>
                        <td>
                            {{ $test->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.test.fields.content') }}
                        </th>
                        <td>
                            {!! $test->content !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.test.fields.file') }}
                        </th>
                        <td>
                            @foreach($test->file as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.test.fields.date') }}
                        </th>
                        <td>
                            {{ $test->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.test.fields.doctor') }}
                        </th>
                        <td>
                            {{ $test->doctor->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.test.fields.patient') }}
                        </th>
                        <td>
                            {{ $test->patient->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.test.fields.isread') }}
                        </th>
                        <td>
                            {{ App\Models\Test::ISREAD_RADIO[$test->isread] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.test.fields.tip') }}
                        </th>
                        <td>
                            {{ $test->tip }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection