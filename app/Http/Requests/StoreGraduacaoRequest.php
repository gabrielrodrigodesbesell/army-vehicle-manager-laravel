<?php

namespace App\Http\Requests;

use App\Models\Graduacao;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreGraduacaoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('graduacao_create');
    }

    public function rules()
    {
        return [
            'descricao' => [
                'string',
                'min:2',
                'required',
                'unique:graduacaos',
            ],
        ];
    }
}
