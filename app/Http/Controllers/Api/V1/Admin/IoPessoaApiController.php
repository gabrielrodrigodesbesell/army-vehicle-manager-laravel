<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIoPessoaRequest;
use App\Http\Requests\UpdateIoPessoaRequest;
use App\Http\Resources\Admin\IoPessoaResource;
use App\Models\IoPessoa;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IoPessoaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('io_pessoa_access'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        return new IoPessoaResource(IoPessoa::with(['responsavel_user', 'user', 'secao'])->get());
    }

    public function store(StoreIoPessoaRequest $request)
    {
        $ioPessoa = IoPessoa::create($request->all());

        return (new IoPessoaResource($ioPessoa))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(IoPessoa $ioPessoa)
    {
        abort_if(Gate::denies('io_pessoa_show'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        return new IoPessoaResource($ioPessoa->load(['responsavel_user', 'user', 'secao']));
    }

    public function update(UpdateIoPessoaRequest $request, IoPessoa $ioPessoa)
    {
        $ioPessoa->update($request->all());

        return (new IoPessoaResource($ioPessoa))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(IoPessoa $ioPessoa)
    {
        abort_if(Gate::denies('io_pessoa_delete'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $ioPessoa->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
