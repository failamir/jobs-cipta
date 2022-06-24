@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.appliedJob.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.applied-jobs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.appliedJob.fields.id') }}
                        </th>
                        <td>
                            {{ $appliedJob->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appliedJob.fields.candidate') }}
                        </th>
                        <td>
                            {{ $appliedJob->candidate->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appliedJob.fields.job') }}
                        </th>
                        <td>
                            {{ $appliedJob->job->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appliedJob.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\AppliedJob::STATUS_SELECT[$appliedJob->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appliedJob.fields.crew_code') }}
                        </th>
                        <td>
                            {{ $appliedJob->crew_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appliedJob.fields.date_of_entry') }}
                        </th>
                        <td>
                            {{ $appliedJob->date_of_entry }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appliedJob.fields.source') }}
                        </th>
                        <td>
                            {{ $appliedJob->source }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appliedJob.fields.applied_position') }}
                        </th>
                        <td>
                            {{ $appliedJob->applied_position->name_position ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appliedJob.fields.department') }}
                        </th>
                        <td>
                            {{ App\Models\AppliedJob::DEPARTMENT_SELECT[$appliedJob->department] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appliedJob.fields.d_o_b') }}
                        </th>
                        <td>
                            {{ $appliedJob->d_o_b }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appliedJob.fields.vaccination_yf') }}
                        </th>
                        <td>
                            {{ App\Models\AppliedJob::VACCINATION_YF_RADIO[$appliedJob->vaccination_yf] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appliedJob.fields.vaccination_covid_19') }}
                        </th>
                        <td>
                            {{ App\Models\AppliedJob::VACCINATION_COVID_19_SELECT[$appliedJob->vaccination_covid_19] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appliedJob.fields.cid') }}
                        </th>
                        <td>
                            {{ App\Models\AppliedJob::CID_SELECT[$appliedJob->cid] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appliedJob.fields.coc') }}
                        </th>
                        <td>
                            {{ $appliedJob->coc }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appliedJob.fields.rating_able') }}
                        </th>
                        <td>
                            {{ App\Models\AppliedJob::RATING_ABLE_SELECT[$appliedJob->rating_able] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appliedJob.fields.ccm') }}
                        </th>
                        <td>
                            {{ App\Models\AppliedJob::CCM_SELECT[$appliedJob->ccm] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appliedJob.fields.application_form') }}
                        </th>
                        <td>
                            {{ App\Models\AppliedJob::APPLICATION_FORM_SELECT[$appliedJob->application_form] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appliedJob.fields.interview_date') }}
                        </th>
                        <td>
                            {{ $appliedJob->interview_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appliedJob.fields.interview_by') }}
                        </th>
                        <td>
                            {{ $appliedJob->interview_by }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appliedJob.fields.interview_result') }}
                        </th>
                        <td>
                            {{ App\Models\AppliedJob::INTERVIEW_RESULT_SELECT[$appliedJob->interview_result] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.appliedJob.fields.approved_as') }}
                        </th>
                        <td>
                            {{ $appliedJob->approved_as }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.applied-jobs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection