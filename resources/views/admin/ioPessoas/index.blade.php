@extends('layouts.admin')
@section('content')
@can('io_pessoa_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success btn-io" data-type="io-pessoas" href="{{ route('admin.io-pessoas.create') }}">
                <i class="fa fa-pencil"></i>
                {{ trans('global.add') }} {{ trans('cruds.io.title') }} de {{ trans('cruds.ioPessoa.title_singular') }}
            </a>
            @include('csvImport.modal', ['model' => 'IoPessoa', 'route' => 'admin.io-pessoas.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.entradaSaida.title') }} {{ trans('global.from') }} {{ trans('cruds.ioPessoa.title') }} 
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-IoPessoa">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.ioPessoa.fields.data_hora') }}
                        </th>
                        <th>
                            {{ trans('cruds.ioPessoa.fields.operacao') }}
                        </th>
                        <th>
                            {{ trans('cruds.ioPessoa.fields.responsavel_user') }}
                        </th>
                        <th>
                            {{ trans('cruds.ioPessoa.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.ioPessoa.fields.secao') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ioPessoas as $key => $ioPessoa)
                        <tr data-entry-id="{{ $ioPessoa->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $ioPessoa->data_hora ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\IoPessoa::OPERACAO_RADIO[$ioPessoa->operacao] ?? '' }}
                            </td>
                            <td>
                                {{ $ioPessoa->responsavel_user->name ?? '' }}
                            </td>
                            <td>
                                {{ $ioPessoa->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $ioPessoa->secao->descricao ?? '' }}
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    @can('io_pessoa_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.io-pessoas.show', $ioPessoa->id) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    @endcan

                                    @can('io_pessoa_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.io-pessoas.edit', $ioPessoa->id) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan
                                </div>

                                @can('io_pessoa_delete')
                                    <form action="{{ route('admin.io-pessoas.destroy', $ioPessoa->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" title="{{ trans('global.delete') }}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('io_pessoa_delete')
  let deleteButtonTrans = '<i class="fa fa-trash"></i>'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.io-pessoas.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-IoPessoa:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection