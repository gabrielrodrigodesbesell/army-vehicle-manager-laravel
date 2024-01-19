@extends('layouts.admin')
@section('content')
@can('codigo_qr_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.codigo-qrs.create') }}">
                <i class="fa fa-pencil"></i> 
                {{ trans('global.add') }} {{ trans('cruds.codigoQr.title_singular') }}
            </a>
            @include('csvImport.modal', ['model' => 'CodigoQr', 'route' => 'admin.codigo-qrs.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.codigoQr.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-CodigoQr">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.codigoQr.fields.code') }}
                    </th>
                    <th>
                        {{ trans('cruds.codigoQr.fields.veiculo') }}
                    </th>
                    <th>
                        {{ trans('cruds.veiculo.fields.placa') }}
                    </th>
                    <th>
                        {{ trans('cruds.codigoQr.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.codigoQr.title') }}
                    </th>
                    <th style="width: 70px;">
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('codigo_qr_delete')
  let deleteButtonTrans = '<i class="fa fa-trash"></i>';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.codigo-qrs.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.codigo-qrs.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'code', name: 'code' },
{ data: 'veiculo_descricao', name: 'veiculo.descricao' },
{ data: 'veiculo.placa', name: 'veiculo.placa' },
{ data: 'user_name', name: 'user.name' },
{ data: 'user.email', name: 'user.email' },
{ data: 'qrcode', name: 'qrcode', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-CodigoQr').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection