<div class="list-group">
    @foreach($ioPessoas as $key => $ioPessoa)
        <a href="@can('io_pessoa_show'){{ route('admin.io-pessoas.show', $ioPessoa->id) }}@endcan" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">{{ $ioPessoa->user->name ?? '' }}<br>{{ $ioPessoa->user->cpf ?? '' }}</h5>
            <small class="text-muted card-io">
            <img src="{{url('image/'.App\Models\ioPessoa::OPERACAO_RADIO[$ioPessoa->operacao].'.png')}}" width="50">    
                <div class="car-io-actions">    
                    @can('io_pessoa_edit')
                        <form action="{{ route('admin.io-pessoas.edit', $ioPessoa->id) }}" method="GET" style="display: inline-block;">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" title="{{ trans('global.update') }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></button>
                        </form>
                    @endcan
                    @can('io_pessoa_delete')
                    <form action="{{ route('admin.io-pessoas.destroy', $ioPessoa->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" title="{{ trans('global.delete') }}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                    @endcan
                </div>
            </small>
            </div>
            <p class="mb-1">{{ $ioPessoa->secao->descricao ?? '' }} {{ App\Models\ioPessoa::OPERACAO_RADIO[$ioPessoa->operacao] ?? '' }}</p>
            <small class="text-muted"><strong>Data:</strong> {{ $ioPessoa->data_hora ?? '' }}</small><br>
        </a>
    @endforeach
</div>