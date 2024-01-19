@extends('layouts.admin')
@section('content')
@can('graduacao_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.graduacaos.create') }}">
                <i class="fa fa-pencil"></i>
                {{ trans('global.add') }} {{ trans('cruds.graduacao.title_singular') }}
            </a>            
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.graduacao.title') }} 
    </div>
    <div class="card-body">
        @foreach($graduacoes as $key => $graduacao)
            <a href="@can('graduacao_show'){{ route('admin.graduacaos.show', $graduacao->id) }}@endcan" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{ $graduacao->descricao ?? '' }}</h5>
                <small class="text-muted card-io">
                    <div class="car-io-actions">    
                        @can('graduacao_edit')
                            <form action="{{ route('admin.graduacaos.edit', $graduacao->id) }}" method="GET" style="display: inline-block;">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" title="{{ trans('global.update') }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></button>
                            </form>
                        @endcan
                        @can('graduacao_delete')
                        <form action="{{ route('admin.graduacaos.destroy', $graduacao->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" title="{{ trans('global.delete') }}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                        @endcan
                    </div>
                </small>
                </div>
                <small class="text-muted"><strong>Criado:</strong> {{ $graduacao->created_at ?? '' }}</small><br>
                <small class="text-muted"><strong>Atualizado:</strong> {{ $graduacao->updated_at ?? '' }}</small><br>
            </a>
        @endforeach
    </div>
</div>



@endsection
@section('scripts')
@parent
@endsection
