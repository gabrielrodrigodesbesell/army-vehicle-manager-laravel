<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyVeiculoRequest;
use App\Http\Requests\StoreVeiculoRequest;
use App\Http\Requests\UpdateVeiculoRequest;
use App\Models\Grupo;
use App\Models\Veiculo;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class VeiculosController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('veiculo_access'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));
        $agent = new \Jenssegers\Agent\Agent;
        if ($agent->isMobile()) {
            $veiculos = Veiculo::select('grupos.descricao as grupo','veiculos.*')->join('grupos', 'grupos.id', '=', 'grupo_id')->orderByRaw('descricao DESC')->get();                
            return view('admin.veiculos.mobile.index', compact('veiculos'));
        } else {
        if ($request->ajax()) {
            $query = Veiculo::with(['grupo'])->select(sprintf('%s.*', (new Veiculo())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'veiculo_show';
                $editGate = 'veiculo_edit';
                $deleteGate = 'veiculo_delete';
                $crudRoutePart = 'veiculos';

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
            $table->editColumn('placa', function ($row) {
                return $row->placa ? $row->placa : '';
            });
            $table->editColumn('foto', function ($row) {
                if ($photo = $row->foto) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->addColumn('grupo_descricao', function ($row) {
                return $row->grupo ? $row->grupo->descricao : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'foto', 'grupo']);

            return $table->make(true);
        }

        return view('admin.veiculos.index');
        }
    }

    public function create()
    {
        abort_if(Gate::denies('veiculo_create'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $grupos = Grupo::orderBy('descricao','ASC')->pluck('descricao', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.veiculos.create', compact('grupos'));
    }

    public function store(StoreVeiculoRequest $request)
    {
        $veiculo = Veiculo::create($request->all());

        if ($request->input('foto', false)) {
            $veiculo->addMedia(storage_path('tmp/uploads/' . basename($request->input('foto'))))->toMediaCollection('foto');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $veiculo->id]);
        }

        if($request->input('acao')=="ioveiculo"){
            return redirect()->to(url('/admin/io-veiculos/create/?veiculo='.$veiculo->id));
        }else{
            return redirect()->route('admin.veiculos.index');
        }

    }

    public function edit(Veiculo $veiculo)
    {
        abort_if(Gate::denies('veiculo_edit'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $grupos = Grupo::orderBy('descricao','ASC')->pluck('descricao', 'id')->prepend(trans('global.pleaseSelect'), '');

        $veiculo->load('grupo');

        return view('admin.veiculos.edit', compact('grupos', 'veiculo'));
    }

    public function update(UpdateVeiculoRequest $request, Veiculo $veiculo)
    {
        $veiculo->update($request->all());

        if ($request->input('foto', false)) {
            if (!$veiculo->foto || $request->input('foto') !== $veiculo->foto->file_name) {
                if ($veiculo->foto) {
                    $veiculo->foto->delete();
                }
                $veiculo->addMedia(storage_path('tmp/uploads/' . basename($request->input('foto'))))->toMediaCollection('foto');
            }
        } elseif ($veiculo->foto) {
            $veiculo->foto->delete();
        }

        return redirect()->route('admin.veiculos.index');
    }

    public function show(Veiculo $veiculo)
    {
        abort_if(Gate::denies('veiculo_show'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $veiculo->load('grupo');

        return view('admin.veiculos.show', compact('veiculo'));
    }

    public function destroy(Veiculo $veiculo)
    {
        abort_if(Gate::denies('veiculo_delete'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $veiculo->delete();

        return back();
    }

    public function massDestroy(MassDestroyVeiculoRequest $request)
    {
        Veiculo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('veiculo_create') && Gate::denies('veiculo_edit'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $model         = new Veiculo();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
