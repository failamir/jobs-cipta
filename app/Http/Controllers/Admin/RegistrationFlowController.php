<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyRegistrationFlowRequest;
use App\Http\Requests\StoreRegistrationFlowRequest;
use App\Http\Requests\UpdateRegistrationFlowRequest;
use App\Models\Job;
use App\Models\RegistrationFlow;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistrationFlowController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('registration_flow_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $registrationFlows = RegistrationFlow::with(['job'])->get();

        $jobs = Job::get();

        return view('admin.registrationFlows.index', compact('jobs', 'registrationFlows'));
    }

    public function create()
    {
        abort_if(Gate::denies('registration_flow_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobs = Job::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.registrationFlows.create', compact('jobs'));
    }

    public function store(StoreRegistrationFlowRequest $request)
    {
        $registrationFlow = RegistrationFlow::create($request->all());

        return redirect()->route('admin.registration-flows.index');
    }

    public function edit(RegistrationFlow $registrationFlow)
    {
        abort_if(Gate::denies('registration_flow_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobs = Job::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $registrationFlow->load('job');

        return view('admin.registrationFlows.edit', compact('jobs', 'registrationFlow'));
    }

    public function update(UpdateRegistrationFlowRequest $request, RegistrationFlow $registrationFlow)
    {
        $registrationFlow->update($request->all());

        return redirect()->route('admin.registration-flows.index');
    }

    public function show(RegistrationFlow $registrationFlow)
    {
        abort_if(Gate::denies('registration_flow_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $registrationFlow->load('job');

        return view('admin.registrationFlows.show', compact('registrationFlow'));
    }

    public function destroy(RegistrationFlow $registrationFlow)
    {
        abort_if(Gate::denies('registration_flow_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $registrationFlow->delete();

        return back();
    }

    public function massDestroy(MassDestroyRegistrationFlowRequest $request)
    {
        RegistrationFlow::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
