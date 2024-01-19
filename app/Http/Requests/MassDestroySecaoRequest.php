<?php

namespace App\Http\Requests;

use App\Models\Seco;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySecaoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('secao_delete'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:secoes,id',
        ];
    }
}
