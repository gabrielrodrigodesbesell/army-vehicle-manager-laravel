@extends('layouts.admin')
@section('content')
@can('user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.users.create') }}">
                <i class="fa fa-pencil"></i>
                {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
            </a>
            @include('csvImport.modal', ['model' => 'User', 'route' => 'admin.users.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.user.title') }} 
    </div>

    <div class="card-body">
        <div class="list-group">
            @foreach($users as $key => $user)
                <a href="@can('user_show'){{ route('admin.users.show', $user->id) }}@endcan" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $user->name ?? '' }}</h5>
                    <small class="text-muted card-io">
                        <div class="car-io-actions">    
                            @can('user_edit')
                                <form action="{{ route('admin.users.edit', $user->id) }}" method="GET" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" title="{{ trans('global.update') }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></button>
                                </form>
                            @endcan
                            @can('user_delete')
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" title="{{ trans('global.delete') }}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                            @endcan
                        </div>
                    </small>
                    </div>
                    <small class="text-muted"><strong>CPF:</strong> {{ $user->cpf ?? '' }}</small><br>
                    <small class="text-muted"><strong>Grupo:</strong> {{ $user->grupo ?? '' }}</small><br>
                </a>
            @endforeach
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
@endsection
