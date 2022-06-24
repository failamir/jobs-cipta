<?php

namespace App\Http\Requests;

use App\Models\JobPosition;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateJobPositionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('job_position_edit');
    }

    public function rules()
    {
        return [
            'name_position' => [
                'string',
                'nullable',
            ],
        ];
    }
}
