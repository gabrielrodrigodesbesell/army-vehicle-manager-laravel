@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.io.title') }} de {{ trans('cruds.ioVeiculo.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.io-veiculos.update", [$ioVeiculo->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="hidden"  name="responsavel_user_id" id="user_responsvel_id" required value="{{ auth()->user()->id }}">
            <div class="form-group">
                <label class="required" for="data_hora">{{ trans('cruds.ioVeiculo.fields.data_hora') }}</label>
                <input class="form-control datetime {{ $errors->has('data_hora') ? 'is-invalid' : '' }}" type="text" name="data_hora" id="data_hora" value="{{ old('data_hora', $ioVeiculo->data_hora) }}" required>
                @if($errors->has('data_hora'))
                    <div class="invalid-feedback">
                        {{ $errors->first('data_hora') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ioVeiculo.fields.data_hora_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="missao">{{ trans('cruds.ioVeiculo.fields.missao') }}</label>
                <input class="form-control {{ $errors->has('missao') ? 'is-invalid' : '' }}" type="text" name="missao" id="missao" value="{{ old('missao', $ioVeiculo->missao) }}" required>
                @if($errors->has('missao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('missao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ioVeiculo.fields.missao_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.ioVeiculo.fields.operacao') }}</label>
                @foreach(App\Models\IoVeiculo::OPERACAO_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('operacao') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="operacao_{{ $key }}" name="operacao" value="{{ $key }}" {{ old('operacao', $ioVeiculo->operacao) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="operacao_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('operacao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('operacao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ioVeiculo.fields.operacao_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="secao_id">{{ trans('cruds.ioVeiculo.fields.secao') }}</label>
                <select class="form-control select2 {{ $errors->has('secao') ? 'is-invalid' : '' }}" name="secao_id" id="secao_id" required>
                    @foreach($secaos as $id => $entry)
                        <option value="{{ $id }}" {{ (old('secao_id') ? old('secao_id') : $ioVeiculo->secao->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('secao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('secao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ioVeiculo.fields.secao_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="veiculo_id">{{ trans('cruds.ioVeiculo.fields.veiculo') }}</label>
                <select class="form-control select2 {{ $errors->has('veiculo') ? 'is-invalid' : '' }}" name="veiculo_id" id="veiculo_id" required>
                    @foreach($veiculos as $id => $entry)
                        <option value="{{ $id }}" {{ (old('veiculo_id') ? old('veiculo_id') : $ioVeiculo->veiculo->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('veiculo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('veiculo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ioVeiculo.fields.veiculo_helper') }}</span>
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