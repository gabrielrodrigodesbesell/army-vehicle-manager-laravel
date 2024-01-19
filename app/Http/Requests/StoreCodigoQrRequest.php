<?php

namespace App\Http\Requests;

use App\Models\CodigoQr;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCodigoQrRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('codigo_qr_create');
    }

    public function rules()
    {
        return [
            'code' => [
                'string',
                'required',
            ],
        ];
    }
}
