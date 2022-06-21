@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.registrationFlow.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.registration-flows.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="job_id">{{ trans('cruds.registrationFlow.fields.job') }}</label>
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
                <span class="help-block">{{ trans('cruds.registrationFlow.fields.job_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="flow">{{ trans('cruds.registrationFlow.fields.flow') }}</label>
                <input class="form-control {{ $errors->has('flow') ? 'is-invalid' : '' }}" type="text" name="flow" id="flow" value="{{ old('flow', '') }}">
                @if($errors->has('flow'))
                    <div class="invalid-feedback">
                        {{ $errors->first('flow') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.registrationFlow.fields.flow_helper') }}</span>
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