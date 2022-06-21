<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobAlertRequest;
use App\Http\Requests\UpdateJobAlertRequest;
use App\Http\Resources\Admin\JobAlertResource;
use App\Models\JobAlert;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JobAlertsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('job_alert_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JobAlertResource(JobAlert::with(['candidate', 'job'])->get());
    }

    public function store(StoreJobAlertRequest $request)
    {
        $jobAlert = JobAlert::create($request->all());

        return (new JobAlertResource($jobAlert))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(JobAlert $jobAlert)
    {
        abort_if(Gate::denies('job_alert_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JobAlertResource($jobAlert->load(['candidate', 'job']));
    }

    public function update(UpdateJobAlertRequest $request, JobAlert $jobAlert)
    {
        $jobAlert->update($request->all());

        return (new JobAlertResource($jobAlert))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(JobAlert $jobAlert)
    {
        abort_if(Gate::denies('job_alert_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobAlert->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
