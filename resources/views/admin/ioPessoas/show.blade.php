@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.io.title') }} de {{ trans('cruds.ioPessoa.title_singular') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.io-pessoas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ioPessoa.fields.id') }}
                        </th>
                        <td>
                            {{ $ioPessoa->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ioPessoa.fields.data_hora') }}
                        </th>
                        <td>
                            {{ $ioPessoa->data_hora }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ioPessoa.fields.operacao') }}
                        </th>
                        <td>
                            {{ App\Models\IoPessoa::OPERACAO_RADIO[$ioPessoa->operacao] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ioPessoa.fields.responsavel_user') }}
                        </th>
                        <td>
                            {{ $ioPessoa->responsavel_user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ioPessoa.fields.user') }}
                        </th>
                        <td>
                            {{ $ioPessoa->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ioPessoa.fields.secao') }}
                        </th>
                        <td>
                            {{ $ioPessoa->secao->descricao ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.io-pessoas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection