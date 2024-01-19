<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyIoPessoaRequest;
use App\Http\Requests\StoreIoPessoaRequest;
use App\Http\Requests\UpdateIoPessoaRequest;
use App\Models\IoPessoa;
use App\Models\Seco;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IoPessoaController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('io_pessoa_access'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $ioPessoas = IoPessoa::with(['responsavel_user', 'user', 'secao'])->orderByRaw('id DESC')->get();
        $agent = new \Jenssegers\Agent\Agent;
        return view('admin.ioPessoas.'.(($agent->isMobile()?'mobile.':null)).'index', compact('ioPessoas'));
    }

    public function create()
    {
        abort_if(Gate::denies('io_pessoa_create'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $responsavel_users = User::orderBy('name','ASC')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::orderBy('name','ASC')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $secaos = Seco::orderBy('descricao','ASC')->pluck('descricao', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.ioPessoas.create', compact('responsavel_users', 'secaos', 'users'));
    }

    public function store(StoreIoPessoaRequest $request)
    {
        $ioPessoa = IoPessoa::create($request->all());

        return redirect()->route('admin.io-pessoas.index');
    }

    public function edit(IoPessoa $ioPessoa)
    {
        abort_if(Gate::denies('io_pessoa_edit'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $responsavel_users = User::orderBy('name','ASC')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::orderBy('name','ASC')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $secaos = Seco::orderBy('descricao','ASC')->pluck('descricao', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ioPessoa->load('responsavel_user', 'user', 'secao');

        return view('admin.ioPessoas.edit', compact('ioPessoa', 'responsavel_users', 'secaos', 'users'));
    }

    public function update(UpdateIoPessoaRequest $request, IoPessoa $ioPessoa)
    {
        $ioPessoa->update($request->all());

        return redirect()->route('admin.io-pessoas.index');
    }

    public function show(IoPessoa $ioPessoa)
    {
        abort_if(Gate::denies('io_pessoa_show'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $ioPessoa->load('responsavel_user', 'user', 'secao');

        return view('admin.ioPessoas.show', compact('ioPessoa'));
    }

    public function destroy(IoPessoa $ioPessoa)
    {
        abort_if(Gate::denies('io_pessoa_delete'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $ioPessoa->delete();

        return back();
    }

    public function massDestroy(MassDestroyIoPessoaRequest $request)
    {
        IoPessoa::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
