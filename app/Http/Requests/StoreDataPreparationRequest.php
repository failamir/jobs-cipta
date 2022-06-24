<?php

namespace App\Http\Requests;

use App\Models\DataPreparation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDataPreparationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('data_preparation_create');
    }

    public function rules()
    {
        return [
            'nama' => [
                'string',
                'nullable',
            ],
            'akses_file' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'akses_video' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'akses_forum' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'kuis_1' => [
                'numeric',
            ],
            'kuis_2' => [
                'numeric',
            ],
            'tugas_1' => [
                'numeric',
            ],
            'tugas_2' => [
                'string',
                'nullable',
            ],
            'nilai_akhir' => [
                'numeric',
            ],
        ];
    }
}
