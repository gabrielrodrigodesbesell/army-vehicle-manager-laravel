@extends('layouts.admin')
@section('content')
@can('grupo_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.grupos.create') }}">
                <i class="fa fa-pencil"></i>
                {{ trans('global.add') }} {{ trans('cruds.grupo.title_singular') }}
            </a>            
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.grupo.title') }} 
    </div>
    <div class="card-body">
        @foreach($grupos as $key => $grupoo)
            <a href="@can('grupo_show'){{ route('admin.grupos.show', $grupoo->id) }}@endcan" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{ $grupoo->descricao ?? '' }}</h5>
                <small class="text-muted card-io">
                    <div class="car-io-actions">    
                        @can('grupo_edit')
                            <form action="{{ route('admin.grupos.edit', $grupoo->id) }}" method="GET" style="display: inline-block;">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" title="{{ trans('global.update') }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></button>
                            </form>
                        @endcan
                        @can('grupo_delete')
                        <form action="{{ route('admin.grupos.destroy', $grupoo->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" title="{{ trans('global.delete') }}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                        @endcan
                    </div>
                </small>
                </div>
                <small class="text-muted"><strong>{{trans('cruds.grupo.fields.created_at')}}:</strong> {{ $grupoo->created_at ?? '' }}</small><br>                
                <small class="text-muted"><strong>{{trans('cruds.grupo.fields.externo')}}:</strong> {{ App\Models\Grupo::EXTERNO_RADIO[$grupoo->externo] ?? '' }}</small><br>                
            </a>
        @endforeach
    </div>
</div>



@endsection
@section('scripts')
@parent
@endsection
