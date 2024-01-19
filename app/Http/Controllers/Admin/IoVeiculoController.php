<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyIoVeiculoRequest;
use App\Http\Requests\StoreIoVeiculoRequest;
use App\Http\Requests\UpdateIoVeiculoRequest;
use App\Models\IoVeiculo;
use App\Models\Seco;
use App\Models\User;
use App\Models\Veiculo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IoVeiculoController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('io_veiculo_access'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $ioVeiculos = IoVeiculo::with(['responsavel_user', 'secao', 'veiculo'])->orderByRaw('id DESC')->get();
        $agent = new \Jenssegers\Agent\Agent;
        return view('admin.ioVeiculos.'.(($agent->isMobile()?'mobile.':null)).'index', compact('ioVeiculos'));
    }

    public function create()
    {
        abort_if(Gate::denies('io_veiculo_create'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $responsavel_users = User::orderBy('name','ASC')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $secaos = Seco::orderBy('descricao','ASC')->pluck('descricao', 'id')->prepend(trans('global.pleaseSelect'), '');

        $veiculos = Veiculo::
        orderByRaw('descricao ASC')
        ->get();

        return view('admin.ioVeiculos.create', compact('responsavel_users', 'secaos', 'veiculos'));
    }

    public function store(StoreIoVeiculoRequest $request)
    {
        $ioVeiculo = IoVeiculo::create($request->all());

        return redirect()->route('admin.io-veiculos.index');
    }

    public function edit(IoVeiculo $ioVeiculo)
    {
        abort_if(Gate::denies('io_veiculo_edit'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $responsavel_users = User::orderBy('name','ASC')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $secaos = Seco::orderBy('descricao','ASC')->pluck('descricao', 'id')->prepend(trans('global.pleaseSelect'), '');

        $veiculos = Veiculo::orderBy('descricao','ASC')->pluck('descricao', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ioVeiculo->load('responsavel_user', 'secao', 'veiculo');

        return view('admin.ioVeiculos.edit', compact('ioVeiculo', 'responsavel_users', 'secaos', 'veiculos'));
    }

    public function update(UpdateIoVeiculoRequest $request, IoVeiculo $ioVeiculo)
    {
        $ioVeiculo->update($request->all());

        return redirect()->route('admin.io-veiculos.index');
    }

    public function show(IoVeiculo $ioVeiculo)
    {
        abort_if(Gate::denies('io_veiculo_show'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $ioVeiculo->load('responsavel_user', 'secao', 'veiculo');

        return view('admin.ioVeiculos.show', compact('ioVeiculo'));
    }

    public function destroy(IoVeiculo $ioVeiculo)
    {
        abort_if(Gate::denies('io_veiculo_delete'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $ioVeiculo->delete();

        return back();
    }

    public function massDestroy(MassDestroyIoVeiculoRequest $request)
    {
        IoVeiculo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
