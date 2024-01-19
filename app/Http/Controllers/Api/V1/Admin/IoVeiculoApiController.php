<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIoVeiculoRequest;
use App\Http\Requests\UpdateIoVeiculoRequest;
use App\Http\Resources\Admin\IoVeiculoResource;
use App\Models\IoVeiculo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IoVeiculoApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('io_veiculo_access'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        return new IoVeiculoResource(IoVeiculo::with(['responsavel_user', 'secao', 'veiculo'])->get());
    }

    public function store(StoreIoVeiculoRequest $request)
    {
        $ioVeiculo = IoVeiculo::create($request->all());

        return (new IoVeiculoResource($ioVeiculo))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(IoVeiculo $ioVeiculo)
    {
        abort_if(Gate::denies('io_veiculo_show'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        return new IoVeiculoResource($ioVeiculo->load(['responsavel_user', 'secao', 'veiculo']));
    }

    public function update(UpdateIoVeiculoRequest $request, IoVeiculo $ioVeiculo)
    {
        $ioVeiculo->update($request->all());

        return (new IoVeiculoResource($ioVeiculo))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(IoVeiculo $ioVeiculo)
    {
        abort_if(Gate::denies('io_veiculo_delete'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $ioVeiculo->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
