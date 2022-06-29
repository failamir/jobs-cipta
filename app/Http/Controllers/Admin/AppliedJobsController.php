<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAppliedJobRequest;
use App\Http\Requests\StoreAppliedJobRequest;
use App\Http\Requests\UpdateAppliedJobRequest;
use App\Models\AppliedJob;
use App\Models\Job;
use App\Models\JobAlert;
use App\Models\JobPosition;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AppliedJobsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('applied_job_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if(Auth::id() == 1){
            $appliedJobs = AppliedJob::with(['candidate', 'job', 'applied_position'])->get();    
        }else{
            $appliedJobs = AppliedJob::with(['candidate', 'job', 'applied_position'])
            ->where('candidate_id',Auth::id())->get();    
        }
        
        $users = User::get();

        $jobs = Job::get();

        $job_positions = JobPosition::get();

        return view('admin.appliedJobs.index', compact('appliedJobs', 'job_positions', 'jobs', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('applied_job_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $candidates = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jobs = Job::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $applied_positions = JobPosition::pluck('name_position', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.appliedJobs.create', compact('applied_positions', 'candidates', 'jobs'));
    }

    public function apply(Request $request)
    {
        // abort_if(Gate::denies('applied_job_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        abort_if(Gate::denies('applied_job_create'), redirect('/register'));
        // var_dump($request->route('id'));
        // $data = array_merge($request->all(),['approved' => true]);
        $data = array(
            'candidate_id' => Auth::id(),
            'job_id' => $request->route('id')
        );
        // var_dump($data);
        
        $appliedJob = AppliedJob::create($data);
        // var_dump($appliedJob);
        // die;
        $candidates = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jobs = Job::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $applied_positions = JobPosition::pluck('name_position', 'id')->prepend(trans('global.pleaseSelect'), '');

        if(Auth::id() == 1){
            $appliedJobs = AppliedJob::with(['candidate', 'job', 'applied_position'])->get();    
        }else{
            $appliedJobs = AppliedJob::with(['candidate', 'job', 'applied_position'])
            ->where('candidate_id',Auth::id())->get();    
        }
        
        $users = User::get();

        $jobs = Job::get();

        $job_positions = JobPosition::get();

        return view('admin.appliedJobs.index', compact('appliedJobs', 'job_positions', 'jobs', 'users'));
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

        $applied_positions = JobPosition::pluck('name_position', 'id')->prepend(trans('global.pleaseSelect'), '');

        $appliedJob->load('candidate', 'job', 'applied_position');

        return view('admin.appliedJobs.edit', compact('appliedJob', 'applied_positions', 'candidates', 'jobs'));
    }

    public function update(UpdateAppliedJobRequest $request, AppliedJob $appliedJob)
    {
        $appliedJob->update($request->all());
        if($request->input('status') == 'pass'){
            // $data = array(
            //     'candidate_id' => Auth::id(),
            //     'job_id' => $request->input('job_id'),
            //     'status' => 'unread'
            // );
            $jobAlert = JobAlert::create([
                'candidate_id' => $request->input('candidate_id'),
                'job_id' => $request->input('job_id'),
                'status' => 'unread'
            ]);
            // var_dump($jobAlert);
            // echo 0000;
        }
        if($request->input('status') == 'fail'){
            // $data = array(
            //     'candidate_id' => Auth::id(),
            //     'job_id' => $request->input('job_id'),
            //     'status' => 'unread'
            // );
            $jobAlert = JobAlert::create([
                'candidate_id' => $request->input('candidate_id'),
                'job_id' => $request->input('job_id'),
                'status' => 'read'
            ]);
            // var_dump($jobAlert);
            // echo 0000;
        }

        return redirect()->route('admin.applied-jobs.index');
    }

    public function show(AppliedJob $appliedJob)
    {
        abort_if(Gate::denies('applied_job_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appliedJob->load('candidate', 'job', 'applied_position');

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
