@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.test.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.tests.update", [$test->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="title">{{ trans('cruds.test.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $test->title) }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.test.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="content">{{ trans('cruds.test.fields.content') }}</label>
                            <textarea class="form-control ckeditor" name="content" id="content">{!! old('content', $test->content) !!}</textarea>
                            @if($errors->has('content'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('content') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.test.fields.content_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="file">{{ trans('cruds.test.fields.file') }}</label>
                            <div class="needsclick dropzone" id="file-dropzone">
                            </div>
                            @if($errors->has('file'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('file') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.test.fields.file_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="date">{{ trans('cruds.test.fields.date') }}</label>
                            <input class="form-control datetime" type="text" name="date" id="date" value="{{ old('date', $test->date) }}" required>
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.test.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="doctor_id">{{ trans('cruds.test.fields.doctor') }}</label>
                            <select class="form-control select2" name="doctor_id" id="doctor_id" required>
                                @foreach($doctors as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('doctor_id') ? old('doctor_id') : $test->doctor->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('doctor'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('doctor') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.test.fields.doctor_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="patient_id">{{ trans('cruds.test.fields.patient') }}</label>
                            <select class="form-control select2" name="patient_id" id="patient_id" required>
                                @foreach($patients as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('patient_id') ? old('patient_id') : $test->patient->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('patient'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('patient') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.test.fields.patient_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="tip">{{ trans('cruds.test.fields.tip') }}</label>
                            <input class="form-control" type="text" name="tip" id="tip" value="{{ old('tip', $test->tip) }}" required>
                            @if($errors->has('tip'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tip') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.test.fields.tip_helper') }}</span>
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
                xhr.open('POST', '{{ route('frontend.tests.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $test->id ?? 0 }}');
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

<script>
    var uploadedFileMap = {}
Dropzone.options.fileDropzone = {
    url: '{{ route('frontend.tests.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="file[]" value="' + response.name + '">')
      uploadedFileMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFileMap[file.name]
      }
      $('form').find('input[name="file[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($test) && $test->file)
          var files =
            {!! json_encode($test->file) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="file[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection