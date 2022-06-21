<?php

namespace App\Http\Requests;

use App\Models\RegistrationFlow;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRegistrationFlowRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('registration_flow_create');
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
