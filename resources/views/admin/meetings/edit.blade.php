@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.meeting.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.meetings.update", [$meeting->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="job_id">{{ trans('cruds.meeting.fields.job') }}</label>
                <select class="form-control select2 {{ $errors->has('job') ? 'is-invalid' : '' }}" name="job_id" id="job_id">
                    @foreach($jobs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('job_id') ? old('job_id') : $meeting->job->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('job'))
                    <div class="invalid-feedback">
                        {{ $errors->first('job') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.meeting.fields.job_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="candidate_id">{{ trans('cruds.meeting.fields.candidate') }}</label>
                <select class="form-control select2 {{ $errors->has('candidate') ? 'is-invalid' : '' }}" name="candidate_id" id="candidate_id">
                    @foreach($candidates as $id => $entry)
                        <option value="{{ $id }}" {{ (old('candidate_id') ? old('candidate_id') : $meeting->candidate->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('candidate'))
                    <div class="invalid-feedback">
                        {{ $errors->first('candidate') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.meeting.fields.candidate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_expired">{{ trans('cruds.meeting.fields.date_expired') }}</label>
                <input class="form-control datetime {{ $errors->has('date_expired') ? 'is-invalid' : '' }}" type="text" name="date_expired" id="date_expired" value="{{ old('date_expired', $meeting->date_expired) }}">
                @if($errors->has('date_expired'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_expired') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.meeting.fields.date_expired_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.meeting.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', $meeting->link) }}">
                @if($errors->has('link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.meeting.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.meeting.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Meeting::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $meeting->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.meeting.fields.status_helper') }}</span>
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