<?php

namespace App\Http\Requests;

use App\Models\AppliedJob;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAppliedJobRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('applied_job_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:applied_jobs,id',
        ];
    }
}
