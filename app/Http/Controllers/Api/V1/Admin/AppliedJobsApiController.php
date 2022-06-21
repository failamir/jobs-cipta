<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppliedJobRequest;
use App\Http\Requests\UpdateAppliedJobRequest;
use App\Http\Resources\Admin\AppliedJobResource;
use App\Models\AppliedJob;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppliedJobsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('applied_job_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AppliedJobResource(AppliedJob::with(['candidate', 'job'])->get());
    }

    public function store(StoreAppliedJobRequest $request)
    {
        $appliedJob = AppliedJob::create($request->all());

        return (new AppliedJobResource($appliedJob))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AppliedJob $appliedJob)
    {
        abort_if(Gate::denies('applied_job_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AppliedJobResource($appliedJob->load(['candidate', 'job']));
    }

    public function update(UpdateAppliedJobRequest $request, AppliedJob $appliedJob)
    {
        $appliedJob->update($request->all());

        return (new AppliedJobResource($appliedJob))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AppliedJob $appliedJob)
    {
        abort_if(Gate::denies('applied_job_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appliedJob->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
