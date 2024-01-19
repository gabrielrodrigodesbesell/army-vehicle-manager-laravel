@extends('layouts.admin')
@section('content')
<?php
    $acao = (@$_GET['acao']!=""&&is_numeric(@$_GET['acao']))?@$_GET['acao']:null;
?>
<div class="card">
    <div class="card-header">
        {{ trans('global.add') }} {{ trans('cruds.io.title') }} de {{ trans('cruds.ioVeiculo.title_singular') }}
    </div>

    <div class="card-body">
        <form id="frm-save-io-veiculo" method="POST" action="{{ route("admin.io-veiculos.store") }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden"  name="responsavel_user_id" id="user_responsvel_id" required value="{{ auth()->user()->id }}">
            <div class="form-group">
                <label class="required" for="data_hora">{{ trans('cruds.ioVeiculo.fields.data_hora') }}</label>
                <input class="form-control datetime {{ $errors->has('data_hora') ? 'is-invalid' : '' }}" type="text" name="data_hora" id="data_hora" value="<?=date('d/m/Y H:i:s')?>" required>
                @if($errors->has('data_hora'))
                    <div class="invalid-feedback">
                        {{ $errors->first('data_hora') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ioVeiculo.fields.data_hora_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="missao">{{ trans('cruds.ioVeiculo.fields.missao') }}</label>
                <input class="form-control {{ $errors->has('missao') ? 'is-invalid' : '' }}" type="text" name="missao" id="missao" value="{{ old('missao', '') }}" required>
                @if($errors->has('missao'))
                    <div class="invalid-feedback">
                        {{ $errors->first('missao') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ioVeiculo.fields.missao_helper') }}</span>
            </div>
            <?php
                if($acao!=NULL){
                    ?>
                       <input type="hidden" name="operacao" value="<?=$acao?>">
                    <?php
                }else{
            ?>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.ioPessoa.fields.operacao') }}</label>
                    @foreach(App\Models\IoPessoa::OPERACAO_RADIO as $key => $label)
                        <div class="form-check {{ $errors->has('operacao') ? 'is-invalid' : '' }}">
                            <input class="form-check-input" type="radio" id="operacao_{{ $key }}" name="operacao" value="{{ $key }}" {{ old('operacao', '') === (string) $key ? 'checked' : '' }} required>
                            <label class="form-check-label" for="operacao_{{ $key }}">{{ $label }}</label>
                        </div>
                    @endforeach
                    @if($errors->has('operacao'))
                        <div class="invalid-feedback">
                            {{ $errors->first('operacao') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.ioPessoa.fields.operacao_helper') }}</span>
                </div>
            <?php }?>
            <?php
                if($acao=='0'){
                    ?>
                    <input type="hidden" name="secao_id" value="<?=env('SECAO_SAIDAQUARTEL_ID')?>">
                    <?php
                }else{
              ?>
                <div class="form-group">
                    <label class="required" for="secao_id">{{ trans('cruds.ioPessoa.fields.secao') }}</label>
                    <select class="form-control {{ $errors->has('secao') ? 'is-invalid' : '' }}" name="secao_id" id="secao_id" required>
                        @foreach($secaos as $id => $entry)
                            <option value="{{ $id }}" {{ old('secao_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('secao'))
                        <div class="invalid-feedback">
                            {{ $errors->first('secao') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.ioPessoa.fields.secao_helper') }}</span>
                </div>
            <?php }?>
            <div class="form-group">
                <label class="required" for="veiculo_id">{{ trans('cruds.ioVeiculo.fields.veiculo') }}</label>
                @can('veiculo_create')
                <a href="{{url('/admin/veiculos/create')}}">[{{trans('global.create_new')}}]</a>
                @endcan
                <select <?=(is_numeric(@$_GET['veiculo'])?'readonly':null)?> class="form-control {{ $errors->has('veiculo') ? 'is-invalid' : '' }}" name="veiculo_id" id="veiculo_id" required>
                    <option value="" selected>{{trans('global.pleaseSelect')}}</option>
                    @foreach($veiculos as $id => $entry)
                        <option value="{{ $entry->id }}" {{ old('veiculo_id') == $entry->id ? 'selected' : '' }} <?=($entry->id==@$_GET['veiculo']?'selected':null)?> data-foto="{{ $entry->foto->getUrl() }}" data-descricao="{{ $entry->descricao }}" data-placa="{{ $entry->placa }}">{{ $entry->descricao }} - {{ $entry->placa }}</option>    
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
                <button class="btn btn-info btn-io-veiculos-save" disabled type="button">
                    <i class="fa fa-arrow-right"></i>
                    Prosseguir
                </button>
            </div>
        </form>
    </div>
</div>
@endsection