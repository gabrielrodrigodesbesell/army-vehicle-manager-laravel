<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySecaoRequest;
use App\Http\Requests\StoreSecaoRequest;
use App\Http\Requests\UpdateSecaoRequest;
use App\Models\Seco;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SecoesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('secao_access'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));
        $agent = new \Jenssegers\Agent\Agent;
        if ($agent->isMobile()) {
            $secoes = Seco::orderByRaw('descricao DESC')->get();
            return view('admin.secoes.mobile.index', compact('secoes'));
        } else {
            if ($request->ajax()) {
                $query = Seco::query()->select(sprintf('%s.*', (new Seco())->table));
                $table = Datatables::of($query);

                $table->addColumn('placeholder', '&nbsp;');
                $table->addColumn('actions', '&nbsp;');

                $table->editColumn('actions', function ($row) {
                    $viewGate = 'secao_show';
                    $editGate = 'secao_edit';
                    $deleteGate = 'secao_delete';
                    $crudRoutePart = 'secoes';

                    return view('partials.datatablesActions', compact(
                        'viewGate',
                        'editGate',
                        'deleteGate',
                        'crudRoutePart',
                        'row'
                    ));
                });

                $table->editColumn('id', function ($row) {
                    return $row->id ? $row->id : '';
                });
                $table->editColumn('descricao', function ($row) {
                    return $row->descricao ? $row->descricao : '';
                });

                $table->rawColumns(['actions', 'placeholder']);

                return $table->make(true);
            }

            return view('admin.secoes.index');
        }
    }

    public function create()
    {
        abort_if(Gate::denies('secao_create'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        return view('admin.secoes.create');
    }

    public function store(StoreSecaoRequest $request)
    {
        $seco = Seco::create($request->all());

        return redirect()->route('admin.secoes.index');
    }

    public function edit(Seco $seco)
    {
        abort_if(Gate::denies('secao_edit'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        return view('admin.secoes.edit', compact('seco'));
    }

    public function update(UpdateSecaoRequest $request, Seco $seco)
    {
        $seco->update($request->all());

        return redirect()->route('admin.secoes.index');
    }

    public function show(Seco $seco)
    {
        abort_if(Gate::denies('secao_show'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        return view('admin.secoes.show', compact('seco'));
    }

    public function destroy(Seco $seco)
    {
        abort_if(Gate::denies('secao_delete'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $seco->delete();

        return back();
    }

    public function massDestroy(MassDestroySecaoRequest $request)
    {
        Seco::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
