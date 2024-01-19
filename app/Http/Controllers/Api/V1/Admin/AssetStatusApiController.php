<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssetStatusRequest;
use App\Http\Requests\UpdateAssetStatusRequest;
use App\Http\Resources\Admin\AssetStatusResource;
use App\Models\AssetStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssetStatusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('asset_status_access'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        return new AssetStatusResource(AssetStatus::all());
    }

    public function store(StoreAssetStatusRequest $request)
    {
        $assetStatus = AssetStatus::create($request->all());

        return (new AssetStatusResource($assetStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AssetStatus $assetStatus)
    {
        abort_if(Gate::denies('asset_status_show'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        return new AssetStatusResource($assetStatus);
    }

    public function update(UpdateAssetStatusRequest $request, AssetStatus $assetStatus)
    {
        $assetStatus->update($request->all());

        return (new AssetStatusResource($assetStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AssetStatus $assetStatus)
    {
        abort_if(Gate::denies('asset_status_delete'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $assetStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
