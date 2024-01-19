<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreVeiculoRequest;
use App\Http\Requests\UpdateVeiculoRequest;
use App\Http\Resources\Admin\VeiculoResource;
use App\Models\Veiculo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VeiculosApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('veiculo_access'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        return new VeiculoResource(Veiculo::with(['grupo'])->get());
    }

    public function store(StoreVeiculoRequest $request)
    {
        $veiculo = Veiculo::create($request->all());

        if ($request->input('foto', false)) {
            $veiculo->addMedia(storage_path('tmp/uploads/' . basename($request->input('foto'))))->toMediaCollection('foto');
        }

        return (new VeiculoResource($veiculo))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Veiculo $veiculo)
    {
        abort_if(Gate::denies('veiculo_show'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        return new VeiculoResource($veiculo->load(['grupo']));
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

        return (new VeiculoResource($veiculo))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Veiculo $veiculo)
    {
        abort_if(Gate::denies('veiculo_delete'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $veiculo->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
