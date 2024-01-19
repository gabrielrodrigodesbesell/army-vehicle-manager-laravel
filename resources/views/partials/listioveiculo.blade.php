@foreach($ioVeiculos as $key => $ioVeiculo)
    <a href="@can('io_veiculo_show'){{ route('admin.io-veiculos.show', $ioVeiculo->id) }}@endcan" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">{{ $ioVeiculo->veiculo->descricao ?? '' }} - {{ $ioVeiculo->veiculo->placa ?? '' }}</h5>
        <small class="text-muted card-io">
        <img src="{{url('image/'.App\Models\IoVeiculo::OPERACAO_RADIO[$ioVeiculo->operacao].'.png')}}" width="50">    
            <div class="car-io-actions">    
                @can('io_veiculo_edit')
                    <form action="{{ route('admin.io-veiculos.edit', $ioVeiculo->id) }}" method="GET" style="display: inline-block;">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" title="{{ trans('global.update') }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></button>
                    </form>
                @endcan
                @can('io_veiculo_delete')
                <form action="{{ route('admin.io-veiculos.destroy', $ioVeiculo->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" title="{{ trans('global.delete') }}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                </form>
                @endcan
            </div>
        </small>
        </div>
        <p class="mb-1">{{ $ioVeiculo->secao->descricao ?? '' }} {{ App\Models\IoVeiculo::OPERACAO_RADIO[$ioVeiculo->operacao] ?? '' }}</p>
        <small class="text-muted"><strong>Data:</strong> {{ $ioVeiculo->data_hora ?? '' }}</small><br>
        <small><strong>Missão:</strong> {!! Str::limit("$ioVeiculo->missao", 40, ' ...') !!}</small><br>
    </a>                                        
@endforeach