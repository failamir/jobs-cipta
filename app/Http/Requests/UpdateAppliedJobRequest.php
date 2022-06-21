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
        return [];
    }
}
