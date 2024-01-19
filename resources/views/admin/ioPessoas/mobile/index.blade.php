@extends('layouts.admin')
@section('content')
@can('io_pessoa_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success btn-io" data-type="io-pessoas" href="{{ route('admin.io-pessoas.create') }}">
                <i class="fa fa-pencil"></i>
                {{ trans('global.add') }} {{ trans('cruds.io.title') }} {{ trans('cruds.ioPessoa.title_singular') }}
            </a>
            
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.entradaSaida.title') }} {{ trans('global.from') }} {{ trans('cruds.ioPessoa.title') }} 
    </div>

    <div class="card-body">
        @include('partials.listiopessoa')
    </div>
</div>
@endsection
@section('scripts')
@parent
@endsection