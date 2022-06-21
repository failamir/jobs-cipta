<?php

namespace App\Http\Requests;

use App\Models\Meeting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMeetingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('meeting_create');
    }

    public function rules()
    {
        return [
            'date_expired' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'link' => [
                'string',
                'nullable',
            ],
        ];
    }
}
