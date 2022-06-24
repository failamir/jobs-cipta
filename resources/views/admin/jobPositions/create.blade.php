@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.jobPosition.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.job-positions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="job_id">{{ trans('cruds.jobPosition.fields.job') }}</label>
                <select class="form-control select2 {{ $errors->has('job') ? 'is-invalid' : '' }}" name="job_id" id="job_id">
                    @foreach($jobs as $id => $entry)
                        <option value="{{ $id }}" {{ old('job_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('job'))
                    <div class="invalid-feedback">
                        {{ $errors->first('job') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobPosition.fields.job_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name_position">{{ trans('cruds.jobPosition.fields.name_position') }}</label>
                <input class="form-control {{ $errors->has('name_position') ? 'is-invalid' : '' }}" type="text" name="name_position" id="name_position" value="{{ old('name_position', '') }}">
                @if($errors->has('name_position'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_position') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobPosition.fields.name_position_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description_position">{{ trans('cruds.jobPosition.fields.description_position') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description_position') ? 'is-invalid' : '' }}" name="description_position" id="description_position">{!! old('description_position') !!}</textarea>
                @if($errors->has('description_position'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description_position') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobPosition.fields.description_position_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.job-positions.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $jobPosition->id ?? 0 }}');
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