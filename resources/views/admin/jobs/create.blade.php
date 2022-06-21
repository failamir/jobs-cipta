@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.job.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.jobs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">{{ trans('cruds.job.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}">
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.job.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_posted">{{ trans('cruds.job.fields.date_posted') }}</label>
                <input class="form-control date {{ $errors->has('date_posted') ? 'is-invalid' : '' }}" type="text" name="date_posted" id="date_posted" value="{{ old('date_posted') }}">
                @if($errors->has('date_posted'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_posted') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.job.fields.date_posted_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_expired">{{ trans('cruds.job.fields.date_expired') }}</label>
                <input class="form-control date {{ $errors->has('date_expired') ? 'is-invalid' : '' }}" type="text" name="date_expired" id="date_expired" value="{{ old('date_expired') }}">
                @if($errors->has('date_expired'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_expired') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.job.fields.date_expired_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="job_description">{{ trans('cruds.job.fields.job_description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('job_description') ? 'is-invalid' : '' }}" name="job_description" id="job_description">{!! old('job_description') !!}</textarea>
                @if($errors->has('job_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('job_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.job.fields.job_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="requirement">{{ trans('cruds.job.fields.requirement') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('requirement') ? 'is-invalid' : '' }}" name="requirement" id="requirement">{!! old('requirement') !!}</textarea>
                @if($errors->has('requirement'))
                    <div class="invalid-feedback">
                        {{ $errors->first('requirement') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.job.fields.requirement_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="procedure_recruitment">{{ trans('cruds.job.fields.procedure_recruitment') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('procedure_recruitment') ? 'is-invalid' : '' }}" name="procedure_recruitment" id="procedure_recruitment">{!! old('procedure_recruitment') !!}</textarea>
                @if($errors->has('procedure_recruitment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('procedure_recruitment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.job.fields.procedure_recruitment_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.jobs.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $job->id ?? 0 }}');
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