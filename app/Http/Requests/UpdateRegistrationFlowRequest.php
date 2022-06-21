<?php

namespace App\Http\Requests;

use App\Models\RegistrationFlow;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRegistrationFlowRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('registration_flow_edit');
    }

    public function rules()
    {
        return [
            'flow' => [
                'string',
                'nullable',
            ],
        ];
    }
}
