@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.io.title') }} de {{ trans('cruds.ioVeiculo.title_singular') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.io-veiculos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ioVeiculo.fields.id') }}
                        </th>
                        <td>
                            {{ $ioVeiculo->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ioVeiculo.fields.data_hora') }}
                        </th>
                        <td>
                            {{ $ioVeiculo->data_hora }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ioVeiculo.fields.operacao') }}
                        </th>
                        <td>
                            {{ App\Models\IoVeiculo::OPERACAO_RADIO[$ioVeiculo->operacao] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ioVeiculo.fields.responsavel_user') }}
                        </th>
                        <td>
                            {{ $ioVeiculo->responsavel_user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ioVeiculo.fields.secao') }}
                        </th>
                        <td>
                            {{ $ioVeiculo->secao->descricao ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ioVeiculo.fields.missao') }}
                        </th>
                        <td>
                            {{ $ioVeiculo->missao ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ioVeiculo.fields.veiculo') }}
                        </th>
                        <td>
                            {{ $ioVeiculo->veiculo->descricao ?? '' }}
                        </td>
                    </tr>                    
                    <tr>
                        <th>
                            {{ trans('cruds.veiculo.fields.foto') }}
                        </th>
                        <td>
                            <img src="{{ $ioVeiculo->veiculo->foto->getUrl() ?? '' }}" class="img-fluid">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.io-veiculos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection