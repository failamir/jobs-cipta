<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyJobAlertRequest;
use App\Http\Requests\StoreJobAlertRequest;
use App\Http\Requests\UpdateJobAlertRequest;
use App\Models\Job;
use App\Models\JobAlert;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JobAlertsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('job_alert_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobAlerts = JobAlert::with(['candidate', 'job'])->get();

        $users = User::get();

        $jobs = Job::get();

        return view('admin.jobAlerts.index', compact('jobAlerts', 'jobs', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('job_alert_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $candidates = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jobs = Job::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.jobAlerts.create', compact('candidates', 'jobs'));
    }

    public function store(StoreJobAlertRequest $request)
    {
        $jobAlert = JobAlert::create($request->all());

        return redirect()->route('admin.job-alerts.index');
    }

    public function edit(JobAlert $jobAlert)
    {
        abort_if(Gate::denies('job_alert_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $candidates = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jobs = Job::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jobAlert->load('candidate', 'job');

        return view('admin.jobAlerts.edit', compact('candidates', 'jobAlert', 'jobs'));
    }

    public function update(UpdateJobAlertRequest $request, JobAlert $jobAlert)
    {
        $jobAlert->update($request->all());

        return redirect()->route('admin.job-alerts.index');
    }

    public function show(JobAlert $jobAlert)
    {
        abort_if(Gate::denies('job_alert_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobAlert->load('candidate', 'job');

        return view('admin.jobAlerts.show', compact('jobAlert'));
    }

    public function destroy(JobAlert $jobAlert)
    {
        abort_if(Gate::denies('job_alert_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobAlert->delete();

        return back();
    }

    public function massDestroy(MassDestroyJobAlertRequest $request)
    {
        JobAlert::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
