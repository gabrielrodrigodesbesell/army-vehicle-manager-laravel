<?php

namespace App\Http\Requests;

use App\Models\Veiculo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyVeiculoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('veiculo_delete'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:veiculos,id',
        ];
    }
}
