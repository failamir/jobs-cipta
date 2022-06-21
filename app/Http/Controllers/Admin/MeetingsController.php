<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMeetingRequest;
use App\Http\Requests\StoreMeetingRequest;
use App\Http\Requests\UpdateMeetingRequest;
use App\Models\Job;
use App\Models\Meeting;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MeetingsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('meeting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $meetings = Meeting::with(['job', 'candidate'])->get();

        return view('admin.meetings.index', compact('meetings'));
    }

    public function create()
    {
        abort_if(Gate::denies('meeting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobs = Job::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $candidates = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.meetings.create', compact('candidates', 'jobs'));
    }

    public function store(StoreMeetingRequest $request)
    {
        $meeting = Meeting::create($request->all());

        return redirect()->route('admin.meetings.index');
    }

    public function edit(Meeting $meeting)
    {
        abort_if(Gate::denies('meeting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobs = Job::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $candidates = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $meeting->load('job', 'candidate');

        return view('admin.meetings.edit', compact('candidates', 'jobs', 'meeting'));
    }

    public function update(UpdateMeetingRequest $request, Meeting $meeting)
    {
        $meeting->update($request->all());

        return redirect()->route('admin.meetings.index');
    }

    public function show(Meeting $meeting)
    {
        abort_if(Gate::denies('meeting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $meeting->load('job', 'candidate');

        return view('admin.meetings.show', compact('meeting'));
    }

    public function destroy(Meeting $meeting)
    {
        abort_if(Gate::denies('meeting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $meeting->delete();

        return back();
    }

    public function massDestroy(MassDestroyMeetingRequest $request)
    {
        Meeting::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
