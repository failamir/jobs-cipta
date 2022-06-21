<?php

namespace App\Http\Requests;

use App\Models\JobAlert;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateJobAlertRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('job_alert_edit');
    }

    public function rules()
    {
        return [];
    }
}
