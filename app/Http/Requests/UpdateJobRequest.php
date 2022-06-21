<?php

namespace App\Http\Requests;

use App\Models\Job;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateJobRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('job_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
            'date_posted' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'date_expired' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
