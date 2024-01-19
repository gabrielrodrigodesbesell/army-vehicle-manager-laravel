@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.codigoQr.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.codigo-qrs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.codigoQr.fields.id') }}
                        </th>
                        <td>
                            {{ $codigoQr->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.codigoQr.fields.code') }}
                        </th>
                        <td>
                            {{ $codigoQr->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.codigoQr.fields.veiculo') }}
                        </th>
                        <td>
                            {{ $codigoQr->veiculo->descricao ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.codigoQr.fields.user') }}
                        </th>
                        <td>
                            {{ $codigoQr->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.codigoQr.title') }}
                        </th>
                        <td>
                        <img src="../../admin/codigo-qrs/{{ $codigoQr->code }}/qrcode">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.codigo-qrs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection