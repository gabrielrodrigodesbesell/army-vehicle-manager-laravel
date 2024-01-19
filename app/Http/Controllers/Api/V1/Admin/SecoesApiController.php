<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSecaoRequest;
use App\Http\Requests\UpdateSecaoRequest;
use App\Http\Resources\Admin\SecoResource;
use App\Models\Seco;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecoesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('secao_access'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        return new SecoResource(Seco::all());
    }

    public function store(StoreSecaoRequest $request)
    {
        $seco = Seco::create($request->all());

        return (new SecoResource($seco))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Seco $seco)
    {
        abort_if(Gate::denies('secao_show'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        return new SecoResource($seco);
    }

    public function update(UpdateSecaoRequest $request, Seco $seco)
    {
        $seco->update($request->all());

        return (new SecoResource($seco))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Seco $seco)
    {
        abort_if(Gate::denies('secao_delete'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $seco->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
