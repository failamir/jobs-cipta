<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyJobPositionRequest;
use App\Http\Requests\StoreJobPositionRequest;
use App\Http\Requests\UpdateJobPositionRequest;
use App\Models\Job;
use App\Models\JobPosition;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class JobPositionController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('job_position_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobPositions = JobPosition::with(['job'])->get();

        return view('admin.jobPositions.index', compact('jobPositions'));
    }

    public function create()
    {
        abort_if(Gate::denies('job_position_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobs = Job::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.jobPositions.create', compact('jobs'));
    }

    public function store(StoreJobPositionRequest $request)
    {
        $jobPosition = JobPosition::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $jobPosition->id]);
        }

        return redirect()->route('admin.job-positions.index');
    }

    public function edit(JobPosition $jobPosition)
    {
        abort_if(Gate::denies('job_position_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobs = Job::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jobPosition->load('job');

        return view('admin.jobPositions.edit', compact('jobPosition', 'jobs'));
    }

    public function update(UpdateJobPositionRequest $request, JobPosition $jobPosition)
    {
        $jobPosition->update($request->all());

        return redirect()->route('admin.job-positions.index');
    }

    public function show(JobPosition $jobPosition)
    {
        abort_if(Gate::denies('job_position_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobPosition->load('job');

        return view('admin.jobPositions.show', compact('jobPosition'));
    }

    public function destroy(JobPosition $jobPosition)
    {
        abort_if(Gate::denies('job_position_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobPosition->delete();

        return back();
    }

    public function massDestroy(MassDestroyJobPositionRequest $request)
    {
        JobPosition::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('job_position_create') && Gate::denies('job_position_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new JobPosition();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
