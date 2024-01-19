<?php

namespace App\Http\Requests;

use App\Models\Seco;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSecaoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('secao_create');
    }

    public function rules()
    {
        return [
            'descricao' => [
                'string',
                'required',
            ],
        ];
    }
}
