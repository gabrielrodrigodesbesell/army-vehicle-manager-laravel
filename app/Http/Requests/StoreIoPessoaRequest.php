<?php

namespace App\Http\Requests;

use App\Models\IoPessoa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreIoPessoaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('io_pessoa_create');
    }

    public function rules()
    {
        return [
            'data_hora' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'operacao' => [
                'required',
            ],
            'responsavel_user_id' => [
                'required',
                'integer',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'secao_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
