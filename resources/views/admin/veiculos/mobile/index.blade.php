@extends('layouts.admin')
@section('content')
@can('veiculo_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.veiculos.create') }}">
                <i class="fa fa-pencil"></i>
                {{ trans('global.add') }} {{ trans('cruds.veiculo.title_singular') }}
            </a>
            @include('csvImport.modal', ['model' => 'Veiculo', 'route' => 'admin.veiculos.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.veiculo.title') }} 
    </div>
    <div class="card-body">
        @foreach($veiculos as $key => $veiculo)
            <a href="@can('veiculo_show'){{ route('admin.veiculos.show', $veiculo->id) }}@endcan" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{ $veiculo->descricao ?? '' }}</h5>
                <small class="text-muted card-io">
                    <div class="car-io-actions">    
                        @can('veiculo_edit')
                            <form action="{{ route('admin.veiculos.edit', $veiculo->id) }}" method="GET" style="display: inline-block;">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" title="{{ trans('global.update') }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></button>
                            </form>
                        @endcan
                        @can('veiculo_delete')
                        <form action="{{ route('admin.veiculos.destroy', $veiculo->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" title="{{ trans('global.delete') }}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                        @endcan
                    </div>
                </small>
                </div>
                <small class="text-muted"><strong>Placa:</strong> {{ $veiculo->placa ?? '' }}</small><br>
                <small class="text-muted"><strong>Grupo:</strong> {{ $veiculo->grupo ?? '' }}</small><br>
            </a>
        @endforeach
    </div>
</div>



@endsection
@section('scripts')
@parent
@endsection
