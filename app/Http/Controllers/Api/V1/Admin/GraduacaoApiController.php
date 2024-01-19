<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGraduacaoRequest;
use App\Http\Requests\UpdateGraduacaoRequest;
use App\Http\Resources\Admin\GraduacaoResource;
use App\Models\Graduacao;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GraduacaoApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('graduacao_access'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        return new GraduacaoResource(Graduacao::all());
    }

    public function store(StoreGraduacaoRequest $request)
    {
        $graduacao = Graduacao::create($request->all());

        return (new GraduacaoResource($graduacao))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Graduacao $graduacao)
    {
        abort_if(Gate::denies('graduacao_show'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        return new GraduacaoResource($graduacao);
    }

    public function update(UpdateGraduacaoRequest $request, Graduacao $graduacao)
    {
        $graduacao->update($request->all());

        return (new GraduacaoResource($graduacao))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Graduacao $graduacao)
    {
        abort_if(Gate::denies('graduacao_delete'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $graduacao->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
