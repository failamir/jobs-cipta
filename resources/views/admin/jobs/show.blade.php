@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.job.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.jobs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.id') }}
                        </th>
                        <td>
                            {{ $job->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.title') }}
                        </th>
                        <td>
                            {{ $job->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.date_posted') }}
                        </th>
                        <td>
                            {{ $job->date_posted }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.date_expired') }}
                        </th>
                        <td>
                            {{ $job->date_expired }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.job_description') }}
                        </th>
                        <td>
                            {!! $job->job_description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.requirement') }}
                        </th>
                        <td>
                            {!! $job->requirement !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.procedure_recruitment') }}
                        </th>
                        <td>
                            {!! $job->procedure_recruitment !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.jobs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#job_registration_flows" role="tab" data-toggle="tab">
                {{ trans('cruds.registrationFlow.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#job_applied_jobs" role="tab" data-toggle="tab">
                {{ trans('cruds.appliedJob.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#job_meetings" role="tab" data-toggle="tab">
                {{ trans('cruds.meeting.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#job_job_alerts" role="tab" data-toggle="tab">
                {{ trans('cruds.jobAlert.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="job_registration_flows">
            @includeIf('admin.jobs.relationships.jobRegistrationFlows', ['registrationFlows' => $job->jobRegistrationFlows])
        </div>
        <div class="tab-pane" role="tabpanel" id="job_applied_jobs">
            @includeIf('admin.jobs.relationships.jobAppliedJobs', ['appliedJobs' => $job->jobAppliedJobs])
        </div>
        <div class="tab-pane" role="tabpanel" id="job_meetings">
            @includeIf('admin.jobs.relationships.jobMeetings', ['meetings' => $job->jobMeetings])
        </div>
        <div class="tab-pane" role="tabpanel" id="job_job_alerts">
            @includeIf('admin.jobs.relationships.jobJobAlerts', ['jobAlerts' => $job->jobJobAlerts])
        </div>
    </div>
</div>

@endsection