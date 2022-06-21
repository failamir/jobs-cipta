<?php

namespace App\Http\Requests;

use App\Models\AppliedJob;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAppliedJobRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('applied_job_create');
    }

    public function rules()
    {
        return [];
    }
}
