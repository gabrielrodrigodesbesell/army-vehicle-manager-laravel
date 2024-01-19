@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.grupo.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.grupos.update", [$grupo->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="descricao">{{ trans('cruds.grupo.fields.descricao') }}</label>
                <input class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}" type="text" name="descricao" id="descricao" value="{{ old('descricao', $grupo->descricao) }}" required>
                @if($errors->has('descricao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descricao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.grupo.fields.descricao_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.grupo.fields.externo') }}</label>
                @foreach(App\Models\Grupo::EXTERNO_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('externo') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="externo_{{ $key }}" name="externo" value="{{ $key }}" {{ old('externo', $grupo->externo) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="externo_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('externo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('externo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.grupo.fields.externo_helper') }}</span>
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