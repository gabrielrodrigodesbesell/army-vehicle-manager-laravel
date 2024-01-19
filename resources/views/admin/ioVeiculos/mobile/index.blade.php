@extends('layouts.admin')
@section('content')
@can('io_veiculo_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success btn-io" data-type="io-veiculos" href="{{ route('admin.io-veiculos.create') }}">
                <i class="fa fa-pencil"></i>
                {{ trans('global.add') }} {{ trans('cruds.io.title') }} {{ trans('cruds.ioVeiculo.title_singular') }}
            </a>
            @include('csvImport.modal', ['model' => 'IoVeiculo', 'route' => 'admin.io-veiculos.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.entradaSaida.title') }} {{ trans('global.from') }} {{ trans('cruds.ioVeiculo.title') }} 
    </div>
    <div class="card-body">
        <div class="list-group">
            @include('partials.listioveiculo')      
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
@endsection