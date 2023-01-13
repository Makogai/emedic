@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.medication.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.medications.update", [$medication->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="purpose">{{ trans('cruds.medication.fields.purpose') }}</label>
                    <textarea class="form-control ckeditor {{ $errors->has('purpose') ? 'is-invalid' : '' }}" name="purpose" id="purpose">{!! old('purpose', $medication->purpose) !!}</textarea>
                    @if($errors->has('purpose'))
                        <span class="text-danger">{{ $errors->first('purpose') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.medication.fields.purpose_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="usage">{{ trans('cruds.medication.fields.usage') }}</label>
                    <textarea class="form-control ckeditor {{ $errors->has('usage') ? 'is-invalid' : '' }}" name="usage" id="usage">{!! old('usage', $medication->usage) !!}</textarea>
                    @if($errors->has('usage'))
                        <span class="text-danger">{{ $errors->first('usage') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.medication.fields.usage_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="doctor_id">{{ trans('cruds.medication.fields.doctor') }}</label>
                    <select class="form-control select2 {{ $errors->has('doctor') ? 'is-invalid' : '' }}" name="doctor_id" id="doctor_id" required>
                        @foreach($doctors as $id => $entry)
                            <option value="{{ $id }}" {{ (old('doctor_id') ? old('doctor_id') : $medication->doctor->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('doctor'))
                        <span class="text-danger">{{ $errors->first('doctor') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.medication.fields.doctor_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="patient_id">{{ trans('cruds.medication.fields.patient') }}</label>
                    <select class="form-control select2 {{ $errors->has('patient') ? 'is-invalid' : '' }}" name="patient_id" id="patient_id" required>
                        @foreach($patients as $id => $entry)
                            <option value="{{ $id }}" {{ (old('patient_id') ? old('patient_id') : $medication->patient->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('patient'))
                        <span class="text-danger">{{ $errors->first('patient') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.medication.fields.patient_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="drug_id">{{ trans('cruds.medication.fields.drug') }}</label>
                    <select class="form-control select2 {{ $errors->has('drug') ? 'is-invalid' : '' }}" name="drug_id" id="drug_id" required>
                        @foreach($drugs as $id => $entry)
                            <option value="{{ $id }}" {{ (old('drug_id') ? old('drug_id') : $medication->drug->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('drug'))
                        <span class="text-danger">{{ $errors->first('drug') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.medication.fields.drug_helper') }}</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>



@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            function SimpleUploadAdapter(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                    return {
                        upload: function() {
                            return loader.file
                                .then(function (file) {
                                    return new Promise(function(resolve, reject) {
                                        // Init request
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST', '{{ route('admin.medications.storeCKEditorImages') }}', true);
                                        xhr.setRequestHeader('x-csrf-token', window._token);
                                        xhr.setRequestHeader('Accept', 'application/json');
                                        xhr.responseType = 'json';

                                        // Init listeners
                                        var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                                        xhr.addEventListener('error', function() { reject(genericErrorText) });
                                        xhr.addEventListener('abort', function() { reject() });
                                        xhr.addEventListener('load', function() {
                                            var response = xhr.response;

                                            if (!response || xhr.status !== 201) {
                                                return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                                            }

                                            $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                                            resolve({ default: response.url });
                                        });

                                        if (xhr.upload) {
                                            xhr.upload.addEventListener('progress', function(e) {
                                                if (e.lengthComputable) {
                                                    loader.uploadTotal = e.total;
                                                    loader.uploaded = e.loaded;
                                                }
                                            });
                                        }

                                        // Send request
                                        var data = new FormData();
                                        data.append('upload', file);
                                        data.append('crud_id', '{{ $medication->id ?? 0 }}');
                                        xhr.send(data);
                                    });
                                })
                        }
                    };
                }
            }

            var allEditors = document.querySelectorAll('.ckeditor');
            for (var i = 0; i < allEditors.length; ++i) {
                ClassicEditor.create(
                    allEditors[i], {
                        extraPlugins: [SimpleUploadAdapter]
                    }
                );
            }
        });
    </script>

@endsection
