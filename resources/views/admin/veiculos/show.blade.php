@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.veiculo.title_singular') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.veiculos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.veiculo.fields.id') }}
                        </th>
                        <td>
                            {{ $veiculo->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.veiculo.fields.descricao') }}
                        </th>
                        <td>
                            {{ $veiculo->descricao }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.veiculo.fields.placa') }}
                        </th>
                        <td>
                            {{ $veiculo->placa }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.veiculo.fields.grupo') }}
                        </th>
                        <td>
                            {{ $veiculo->grupo->descricao ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.veiculo.fields.foto') }}
                        </th>
                        <td>
                            @if($veiculo->foto)
                                <a href="{{ $veiculo->foto->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $veiculo->foto->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <img src="<?=url('admin/codigo-qrs/veiculo-'.$veiculo->id.'/qrcode')?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.veiculos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
