<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegistrationFlowRequest;
use App\Http\Requests\UpdateRegistrationFlowRequest;
use App\Http\Resources\Admin\RegistrationFlowResource;
use App\Models\RegistrationFlow;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistrationFlowApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('registration_flow_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RegistrationFlowResource(RegistrationFlow::with(['job'])->get());
    }

    public function store(StoreRegistrationFlowRequest $request)
    {
        $registrationFlow = RegistrationFlow::create($request->all());

        return (new RegistrationFlowResource($registrationFlow))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RegistrationFlow $registrationFlow)
    {
        abort_if(Gate::denies('registration_flow_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RegistrationFlowResource($registrationFlow->load(['job']));
    }

    public function update(UpdateRegistrationFlowRequest $request, RegistrationFlow $registrationFlow)
    {
        $registrationFlow->update($request->all());

        return (new RegistrationFlowResource($registrationFlow))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RegistrationFlow $registrationFlow)
    {
        abort_if(Gate::denies('registration_flow_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $registrationFlow->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
