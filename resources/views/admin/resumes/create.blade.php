@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.resume.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.resumes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="resume_cv">{{ trans('cruds.resume.fields.resume_cv') }}</label>
                <div class="needsclick dropzone {{ $errors->has('resume_cv') ? 'is-invalid' : '' }}" id="resume_cv-dropzone">
                </div>
                @if($errors->has('resume_cv'))
                    <div class="invalid-feedback">
                        {{ $errors->first('resume_cv') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.resume.fields.resume_cv_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="visa">{{ trans('cruds.resume.fields.visa') }}</label>
                <div class="needsclick dropzone {{ $errors->has('visa') ? 'is-invalid' : '' }}" id="visa-dropzone">
                </div>
                @if($errors->has('visa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('visa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.resume.fields.visa_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="passport">{{ trans('cruds.resume.fields.passport') }}</label>
                <div class="needsclick dropzone {{ $errors->has('passport') ? 'is-invalid' : '' }}" id="passport-dropzone">
                </div>
                @if($errors->has('passport'))
                    <div class="invalid-feedback">
                        {{ $errors->first('passport') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.resume.fields.passport_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bst_ccm">{{ trans('cruds.resume.fields.bst_ccm') }}</label>
                <div class="needsclick dropzone {{ $errors->has('bst_ccm') ? 'is-invalid' : '' }}" id="bst_ccm-dropzone">
                </div>
                @if($errors->has('bst_ccm'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bst_ccm') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.resume.fields.bst_ccm_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="candidate_id">{{ trans('cruds.resume.fields.candidate') }}</label>
                <select class="form-control select2 {{ $errors->has('candidate') ? 'is-invalid' : '' }}" name="candidate_id" id="candidate_id">
                    @foreach($candidates as $id => $entry)
                        <option value="{{ $id }}" {{ old('candidate_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('candidate'))
                    <div class="invalid-feedback">
                        {{ $errors->first('candidate') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.resume.fields.candidate_helper') }}</span>
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
    Dropzone.options.resumeCvDropzone = {
    url: '{{ route('admin.resumes.storeMedia') }}',
    maxFilesize: 32, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 32
    },
    success: function (file, response) {
      $('form').find('input[name="resume_cv"]').remove()
      $('form').append('<input type="hidden" name="resume_cv" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="resume_cv"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($resume) && $resume->resume_cv)
      var file = {!! json_encode($resume->resume_cv) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="resume_cv" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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
<script>
    Dropzone.options.visaDropzone = {
    url: '{{ route('admin.resumes.storeMedia') }}',
    maxFilesize: 32, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 32
    },
    success: function (file, response) {
      $('form').find('input[name="visa"]').remove()
      $('form').append('<input type="hidden" name="visa" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="visa"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($resume) && $resume->visa)
      var file = {!! json_encode($resume->visa) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="visa" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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
<script>
    Dropzone.options.passportDropzone = {
    url: '{{ route('admin.resumes.storeMedia') }}',
    maxFilesize: 32, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 32
    },
    success: function (file, response) {
      $('form').find('input[name="passport"]').remove()
      $('form').append('<input type="hidden" name="passport" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="passport"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($resume) && $resume->passport)
      var file = {!! json_encode($resume->passport) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="passport" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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
<script>
    Dropzone.options.bstCcmDropzone = {
    url: '{{ route('admin.resumes.storeMedia') }}',
    maxFilesize: 32, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 32
    },
    success: function (file, response) {
      $('form').find('input[name="bst_ccm"]').remove()
      $('form').append('<input type="hidden" name="bst_ccm" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="bst_ccm"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($resume) && $resume->bst_ccm)
      var file = {!! json_encode($resume->bst_ccm) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="bst_ccm" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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