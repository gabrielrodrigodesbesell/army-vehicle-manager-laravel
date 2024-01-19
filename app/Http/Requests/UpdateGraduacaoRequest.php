<?php

namespace App\Http\Requests;

use App\Models\Graduacao;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGraduacaoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('graduacao_edit');
    }

    public function rules()
    {
        return [
            'descricao' => [
                'string',
                'min:2',
                'required',
                'unique:graduacaos,descricao,' . request()->route('graduacao')->id,
            ],
        ];
    }
}
