<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyGraduacaoRequest;
use App\Http\Requests\StoreGraduacaoRequest;
use App\Http\Requests\UpdateGraduacaoRequest;
use App\Models\Graduacao;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class GraduacaoController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('graduacao_access'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));
        $agent = new \Jenssegers\Agent\Agent;
        if ($agent->isMobile()) {
            $graduacoes = Graduacao::orderByRaw('descricao DESC')->get();
            return view('admin.graduacaos.mobile.index', compact('graduacoes'));
        } else {
        if ($request->ajax()) {
            $query = Graduacao::query()->select(sprintf('%s.*', (new Graduacao())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'graduacao_show';
                $editGate = 'graduacao_edit';
                $deleteGate = 'graduacao_delete';
                $crudRoutePart = 'graduacaos';

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

        return view('admin.graduacaos.index');
    }
    }

    public function create()
    {
        abort_if(Gate::denies('graduacao_create'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        return view('admin.graduacaos.create');
    }

    public function store(StoreGraduacaoRequest $request)
    {
        $graduacao = Graduacao::create($request->all());

        return redirect()->route('admin.graduacaos.index');
    }

    public function edit(Graduacao $graduacao)
    {
        abort_if(Gate::denies('graduacao_edit'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        return view('admin.graduacaos.edit', compact('graduacao'));
    }

    public function update(UpdateGraduacaoRequest $request, Graduacao $graduacao)
    {
        $graduacao->update($request->all());

        return redirect()->route('admin.graduacaos.index');
    }

    public function show(Graduacao $graduacao)
    {
        abort_if(Gate::denies('graduacao_show'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        return view('admin.graduacaos.show', compact('graduacao'));
    }

    public function destroy(Graduacao $graduacao)
    {
        abort_if(Gate::denies('graduacao_delete'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $graduacao->delete();

        return back();
    }

    public function massDestroy(MassDestroyGraduacaoRequest $request)
    {
        Graduacao::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
