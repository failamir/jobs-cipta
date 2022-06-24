@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.appliedJob.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.applied-jobs.update", [$appliedJob->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="candidate_id">{{ trans('cruds.appliedJob.fields.candidate') }}</label>
                <select class="form-control select2 {{ $errors->has('candidate') ? 'is-invalid' : '' }}" name="candidate_id" id="candidate_id">
                    @foreach($candidates as $id => $entry)
                        <option value="{{ $id }}" {{ (old('candidate_id') ? old('candidate_id') : $appliedJob->candidate->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('candidate'))
                    <div class="invalid-feedback">
                        {{ $errors->first('candidate') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appliedJob.fields.candidate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="job_id">{{ trans('cruds.appliedJob.fields.job') }}</label>
                <select class="form-control select2 {{ $errors->has('job') ? 'is-invalid' : '' }}" name="job_id" id="job_id">
                    @foreach($jobs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('job_id') ? old('job_id') : $appliedJob->job->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('job'))
                    <div class="invalid-feedback">
                        {{ $errors->first('job') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appliedJob.fields.job_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.appliedJob.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\AppliedJob::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $appliedJob->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appliedJob.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="crew_code">{{ trans('cruds.appliedJob.fields.crew_code') }}</label>
                <input class="form-control {{ $errors->has('crew_code') ? 'is-invalid' : '' }}" type="text" name="crew_code" id="crew_code" value="{{ old('crew_code', $appliedJob->crew_code) }}">
                @if($errors->has('crew_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('crew_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appliedJob.fields.crew_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_of_entry">{{ trans('cruds.appliedJob.fields.date_of_entry') }}</label>
                <input class="form-control date {{ $errors->has('date_of_entry') ? 'is-invalid' : '' }}" type="text" name="date_of_entry" id="date_of_entry" value="{{ old('date_of_entry', $appliedJob->date_of_entry) }}">
                @if($errors->has('date_of_entry'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_of_entry') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appliedJob.fields.date_of_entry_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="source">{{ trans('cruds.appliedJob.fields.source') }}</label>
                <input class="form-control {{ $errors->has('source') ? 'is-invalid' : '' }}" type="text" name="source" id="source" value="{{ old('source', $appliedJob->source) }}">
                @if($errors->has('source'))
                    <div class="invalid-feedback">
                        {{ $errors->first('source') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appliedJob.fields.source_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="applied_position_id">{{ trans('cruds.appliedJob.fields.applied_position') }}</label>
                <select class="form-control select2 {{ $errors->has('applied_position') ? 'is-invalid' : '' }}" name="applied_position_id" id="applied_position_id">
                    @foreach($applied_positions as $id => $entry)
                        <option value="{{ $id }}" {{ (old('applied_position_id') ? old('applied_position_id') : $appliedJob->applied_position->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('applied_position'))
                    <div class="invalid-feedback">
                        {{ $errors->first('applied_position') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appliedJob.fields.applied_position_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.appliedJob.fields.department') }}</label>
                <select class="form-control {{ $errors->has('department') ? 'is-invalid' : '' }}" name="department" id="department">
                    <option value disabled {{ old('department', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\AppliedJob::DEPARTMENT_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('department', $appliedJob->department) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('department'))
                    <div class="invalid-feedback">
                        {{ $errors->first('department') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appliedJob.fields.department_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="d_o_b">{{ trans('cruds.appliedJob.fields.d_o_b') }}</label>
                <input class="form-control date {{ $errors->has('d_o_b') ? 'is-invalid' : '' }}" type="text" name="d_o_b" id="d_o_b" value="{{ old('d_o_b', $appliedJob->d_o_b) }}">
                @if($errors->has('d_o_b'))
                    <div class="invalid-feedback">
                        {{ $errors->first('d_o_b') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appliedJob.fields.d_o_b_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.appliedJob.fields.vaccination_yf') }}</label>
                @foreach(App\Models\AppliedJob::VACCINATION_YF_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('vaccination_yf') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="vaccination_yf_{{ $key }}" name="vaccination_yf" value="{{ $key }}" {{ old('vaccination_yf', $appliedJob->vaccination_yf) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="vaccination_yf_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('vaccination_yf'))
                    <div class="invalid-feedback">
                        {{ $errors->first('vaccination_yf') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appliedJob.fields.vaccination_yf_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.appliedJob.fields.vaccination_covid_19') }}</label>
                <select class="form-control {{ $errors->has('vaccination_covid_19') ? 'is-invalid' : '' }}" name="vaccination_covid_19" id="vaccination_covid_19">
                    <option value disabled {{ old('vaccination_covid_19', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\AppliedJob::VACCINATION_COVID_19_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('vaccination_covid_19', $appliedJob->vaccination_covid_19) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('vaccination_covid_19'))
                    <div class="invalid-feedback">
                        {{ $errors->first('vaccination_covid_19') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appliedJob.fields.vaccination_covid_19_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.appliedJob.fields.cid') }}</label>
                <select class="form-control {{ $errors->has('cid') ? 'is-invalid' : '' }}" name="cid" id="cid">
                    <option value disabled {{ old('cid', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\AppliedJob::CID_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('cid', $appliedJob->cid) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('cid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appliedJob.fields.cid_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="coc">{{ trans('cruds.appliedJob.fields.coc') }}</label>
                <input class="form-control {{ $errors->has('coc') ? 'is-invalid' : '' }}" type="text" name="coc" id="coc" value="{{ old('coc', $appliedJob->coc) }}">
                @if($errors->has('coc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('coc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appliedJob.fields.coc_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.appliedJob.fields.rating_able') }}</label>
                <select class="form-control {{ $errors->has('rating_able') ? 'is-invalid' : '' }}" name="rating_able" id="rating_able">
                    <option value disabled {{ old('rating_able', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\AppliedJob::RATING_ABLE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('rating_able', $appliedJob->rating_able) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('rating_able'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rating_able') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appliedJob.fields.rating_able_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.appliedJob.fields.ccm') }}</label>
                <select class="form-control {{ $errors->has('ccm') ? 'is-invalid' : '' }}" name="ccm" id="ccm">
                    <option value disabled {{ old('ccm', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\AppliedJob::CCM_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('ccm', $appliedJob->ccm) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('ccm'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ccm') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appliedJob.fields.ccm_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.appliedJob.fields.application_form') }}</label>
                <select class="form-control {{ $errors->has('application_form') ? 'is-invalid' : '' }}" name="application_form" id="application_form">
                    <option value disabled {{ old('application_form', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\AppliedJob::APPLICATION_FORM_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('application_form', $appliedJob->application_form) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('application_form'))
                    <div class="invalid-feedback">
                        {{ $errors->first('application_form') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appliedJob.fields.application_form_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="interview_date">{{ trans('cruds.appliedJob.fields.interview_date') }}</label>
                <input class="form-control date {{ $errors->has('interview_date') ? 'is-invalid' : '' }}" type="text" name="interview_date" id="interview_date" value="{{ old('interview_date', $appliedJob->interview_date) }}">
                @if($errors->has('interview_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('interview_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appliedJob.fields.interview_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="interview_by">{{ trans('cruds.appliedJob.fields.interview_by') }}</label>
                <input class="form-control {{ $errors->has('interview_by') ? 'is-invalid' : '' }}" type="text" name="interview_by" id="interview_by" value="{{ old('interview_by', $appliedJob->interview_by) }}">
                @if($errors->has('interview_by'))
                    <div class="invalid-feedback">
                        {{ $errors->first('interview_by') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appliedJob.fields.interview_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.appliedJob.fields.interview_result') }}</label>
                <select class="form-control {{ $errors->has('interview_result') ? 'is-invalid' : '' }}" name="interview_result" id="interview_result">
                    <option value disabled {{ old('interview_result', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\AppliedJob::INTERVIEW_RESULT_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('interview_result', $appliedJob->interview_result) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('interview_result'))
                    <div class="invalid-feedback">
                        {{ $errors->first('interview_result') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appliedJob.fields.interview_result_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="approved_as">{{ trans('cruds.appliedJob.fields.approved_as') }}</label>
                <input class="form-control {{ $errors->has('approved_as') ? 'is-invalid' : '' }}" type="text" name="approved_as" id="approved_as" value="{{ old('approved_as', $appliedJob->approved_as) }}">
                @if($errors->has('approved_as'))
                    <div class="invalid-feedback">
                        {{ $errors->first('approved_as') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.appliedJob.fields.approved_as_helper') }}</span>
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