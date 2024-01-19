<?php

namespace App\Http\Requests;

use App\Models\Veiculo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVeiculoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('veiculo_edit');
    }

    public function rules()
    {
        return [
            'descricao' => [
                'string',
                'required',
            ],
            'placa' => [
                'string',
                'required',
            ],
            'grupo_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
