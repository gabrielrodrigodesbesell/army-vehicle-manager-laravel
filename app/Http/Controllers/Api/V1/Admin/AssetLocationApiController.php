<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssetLocationRequest;
use App\Http\Requests\UpdateAssetLocationRequest;
use App\Http\Resources\Admin\AssetLocationResource;
use App\Models\AssetLocation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssetLocationApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('asset_location_access'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        return new AssetLocationResource(AssetLocation::all());
    }

    public function store(StoreAssetLocationRequest $request)
    {
        $assetLocation = AssetLocation::create($request->all());

        return (new AssetLocationResource($assetLocation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AssetLocation $assetLocation)
    {
        abort_if(Gate::denies('asset_location_show'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        return new AssetLocationResource($assetLocation);
    }

    public function update(UpdateAssetLocationRequest $request, AssetLocation $assetLocation)
    {
        $assetLocation->update($request->all());

        return (new AssetLocationResource($assetLocation))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AssetLocation $assetLocation)
    {
        abort_if(Gate::denies('asset_location_delete'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $assetLocation->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
