<?php

namespace App\Http\Requests;

use App\Models\CodigoQr;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCodigoQrRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('codigo_qr_delete'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:codigo_qrs,id',
        ];
    }
}
