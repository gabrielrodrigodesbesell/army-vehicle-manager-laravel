<div class="btn-group" role="group" aria-label="Basic example">
@can($viewGate)
    <a class="btn btn-xs btn-primary" title="{{ trans('global.view') }}" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">
        <i class="fa fa-eye"></i>
    </a>
@endcan
@can($editGate)
    <a class="btn btn-xs btn-info" title="{{ trans('global.edit') }}" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}">
        <i class="fa fa-edit"></i>
    </a>
@endcan
</div>
@can($deleteGate)
    <form style="display: inline;" action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" title="{{ trans('global.delete') }}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
    </form>
@endcan
