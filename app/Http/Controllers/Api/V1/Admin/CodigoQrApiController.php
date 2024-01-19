<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCodigoQrRequest;
use App\Http\Requests\UpdateCodigoQrRequest;
use App\Http\Resources\Admin\CodigoQrResource;
use App\Models\CodigoQr;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CodigoQrApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('codigo_qr_access'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        return new CodigoQrResource(CodigoQr::with(['veiculo', 'user'])->get());
    }

    public function store(StoreCodigoQrRequest $request)
    {
        $codigoQr = CodigoQr::create($request->all());

        return (new CodigoQrResource($codigoQr))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CodigoQr $codigoQr)
    {
        abort_if(Gate::denies('codigo_qr_show'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        return new CodigoQrResource($codigoQr->load(['veiculo', 'user']));
    }

    public function update(UpdateCodigoQrRequest $request, CodigoQr $codigoQr)
    {
        $codigoQr->update($request->all());

        return (new CodigoQrResource($codigoQr))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CodigoQr $codigoQr)
    {
        abort_if(Gate::denies('codigo_qr_delete'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $codigoQr->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
