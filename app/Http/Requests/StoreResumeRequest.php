<?php

namespace App\Http\Requests;

use App\Models\Resume;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreResumeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('resume_create');
    }

    public function rules()
    {
        return [];
    }
}
