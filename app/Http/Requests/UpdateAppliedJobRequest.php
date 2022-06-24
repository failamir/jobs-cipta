<?php

namespace App\Http\Requests;

use App\Models\AppliedJob;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAppliedJobRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('applied_job_edit');
    }

    public function rules()
    {
        return [
            'crew_code' => [
                'string',
                'nullable',
            ],
            'date_of_entry' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'source' => [
                'string',
                'nullable',
            ],
            'd_o_b' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'coc' => [
                'string',
                'nullable',
            ],
            'interview_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'interview_by' => [
                'string',
                'nullable',
            ],
            'approved_as' => [
                'string',
                'nullable',
            ],
        ];
    }
}
