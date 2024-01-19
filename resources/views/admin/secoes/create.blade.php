@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.secao.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.secoes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="descricao">{{ trans('cruds.secao.fields.descricao') }}</label>
                <input class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}" type="text" name="descricao" id="descricao" value="{{ old('descricao', '') }}" required>
                @if($errors->has('descricao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descricao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.secao.fields.descricao_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-save"></i> 
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection