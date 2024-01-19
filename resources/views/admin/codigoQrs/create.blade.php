@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.codigoQr.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.codigo-qrs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="code">{{ trans('cruds.codigoQr.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', '') }}" required>
                @if($errors->has('code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.codigoQr.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="veiculo_id">{{ trans('cruds.codigoQr.fields.veiculo') }}</label>
                <select class="form-control select2 {{ $errors->has('veiculo') ? 'is-invalid' : '' }}" name="veiculo_id" id="veiculo_id">
                    @foreach($veiculos as $id => $entry)
                        <option value="{{ $id }}" {{ old('veiculo_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('veiculo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('veiculo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.codigoQr.fields.veiculo_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.codigoQr.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.codigoQr.fields.user_helper') }}</span>
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