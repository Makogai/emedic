@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.medication.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.medications.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="purpose">{{ trans('cruds.medication.fields.purpose') }}</label>
                            <textarea class="form-control ckeditor" name="purpose" id="purpose">{!! old('purpose') !!}</textarea>
                            @if($errors->has('purpose'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('purpose') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.medication.fields.purpose_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="usage">{{ trans('cruds.medication.fields.usage') }}</label>
                            <textarea class="form-control ckeditor" name="usage" id="usage">{!! old('usage') !!}</textarea>
                            @if($errors->has('usage'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('usage') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.medication.fields.usage_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="doctor_id">{{ trans('cruds.medication.fields.doctor') }}</label>
                            <select class="form-control select2" name="doctor_id" id="doctor_id" required>
                                @foreach($doctors as $id => $entry)
                                    <option value="{{ $id }}" {{ old('doctor_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('doctor'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('doctor') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.medication.fields.doctor_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="patient_id">{{ trans('cruds.medication.fields.patient') }}</label>
                            <select class="form-control select2" name="patient_id" id="patient_id" required>
                                @foreach($patients as $id => $entry)
                                    <option value="{{ $id }}" {{ old('patient_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('patient'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('patient') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.medication.fields.patient_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="drugs">{{ trans('cruds.medication.fields.drug') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="drugs[]" id="drugs" multiple required>
                                @foreach($drugs as $id => $drug)
                                    <option value="{{ $id }}" {{ in_array($id, old('drugs', [])) ? 'selected' : '' }}>{{ $drug }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('drugs'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('drugs') }}
                                </div>
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

        </div>
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
                xhr.open('POST', '{{ route('frontend.medications.storeCKEditorImages') }}', true);
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