<?php

namespace App\Http\Requests;

use App\Models\RegistrationFlow;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRegistrationFlowRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('registration_flow_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:registration_flows,id',
        ];
    }
}
