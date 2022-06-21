<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAppliedJobRequest;
use App\Http\Requests\StoreAppliedJobRequest;
use App\Http\Requests\UpdateAppliedJobRequest;
use App\Models\AppliedJob;
use App\Models\Job;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppliedJobsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('applied_job_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appliedJobs = AppliedJob::with(['candidate', 'job'])->get();

        $users = User::get();

        $jobs = Job::get();

        return view('admin.appliedJobs.index', compact('appliedJobs', 'jobs', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('applied_job_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $candidates = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jobs = Job::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.appliedJobs.create', compact('candidates', 'jobs'));
    }

    public function store(StoreAppliedJobRequest $request)
    {
        $appliedJob = AppliedJob::create($request->all());

        return redirect()->route('admin.applied-jobs.index');
    }

    public function edit(AppliedJob $appliedJob)
    {
        abort_if(Gate::denies('applied_job_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $candidates = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jobs = Job::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $appliedJob->load('candidate', 'job');

        return view('admin.appliedJobs.edit', compact('appliedJob', 'candidates', 'jobs'));
    }

    public function update(UpdateAppliedJobRequest $request, AppliedJob $appliedJob)
    {
        $appliedJob->update($request->all());

        return redirect()->route('admin.applied-jobs.index');
    }

    public function show(AppliedJob $appliedJob)
    {
        abort_if(Gate::denies('applied_job_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appliedJob->load('candidate', 'job');

        return view('admin.appliedJobs.show', compact('appliedJob'));
    }

    public function destroy(AppliedJob $appliedJob)
    {
        abort_if(Gate::denies('applied_job_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appliedJob->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppliedJobRequest $request)
    {
        AppliedJob::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
