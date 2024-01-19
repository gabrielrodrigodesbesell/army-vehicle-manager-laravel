<?php

namespace App\Http\Requests;

use App\Models\IoVeiculo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateIoVeiculoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('io_veiculo_edit');
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
            'secao_id' => [
                'required',
                'integer',
            ],
            'veiculo_id' => [
                'required',
                'integer',
            ],
            'missao' => [
                'required',
            ],
        ];
    }
}
