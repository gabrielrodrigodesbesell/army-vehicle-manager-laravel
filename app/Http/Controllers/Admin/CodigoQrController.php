<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCodigoQrRequest;
use App\Http\Requests\StoreCodigoQrRequest;
use App\Http\Requests\UpdateCodigoQrRequest;
use App\Models\CodigoQr;
use App\Models\User;
use App\Models\Veiculo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use QRCode;

class CodigoQrController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('codigo_qr_access'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        if ($request->ajax()) {
            $query = CodigoQr::with(['veiculo', 'user'])->select(sprintf('%s.*', (new CodigoQr())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'codigo_qr_show';
                $editGate = 'codigo_qr_edit';
                $deleteGate = 'codigo_qr_delete';
                $crudRoutePart = 'codigo-qrs';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : '';
            });
            $table->addColumn('veiculo_descricao', function ($row) {
                return $row->veiculo ? $row->veiculo->descricao : '';
            });

            $table->editColumn('veiculo.placa', function ($row) {
                return $row->veiculo ? (is_string($row->veiculo) ? $row->veiculo : $row->veiculo->placa) : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('user.email', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->email) : '';
            });

            $table->addColumn('qrcode', function ($row) {
                $qrurl = url('admin/codigo-qrs/'.$row->code.'/qrcode');
                return sprintf(
                    '<a href="%s" target="_blank"><img src="%s" width="50px"></a>',
                    $qrurl,
                    $qrurl
                );

            });

            $table->rawColumns(['actions', 'placeholder', 'veiculo', 'user','qrcode']);

            return $table->make(true);
        }

        return view('admin.codigoQrs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('codigo_qr_create'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $veiculos = Veiculo::orderBy('descricao','ASC')->pluck('descricao', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::orderBy('name','ASC')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.codigoQrs.create', compact('users', 'veiculos'));
    }

    public function store(StoreCodigoQrRequest $request)
    {
        $codigoQr = CodigoQr::create($request->all());

        return redirect()->route('admin.codigo-qrs.index');
    }

    public function edit(CodigoQr $codigoQr)
    {
        abort_if(Gate::denies('codigo_qr_edit'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $veiculos = Veiculo::orderBy('descricao','ASC')->pluck('descricao', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::orderBy('name','ASC')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $codigoQr->load('veiculo', 'user');

        return view('admin.codigoQrs.edit', compact('codigoQr', 'users', 'veiculos'));
    }

    public function update(UpdateCodigoQrRequest $request, CodigoQr $codigoQr)
    {
        $codigoQr->update($request->all());

        return redirect()->route('admin.codigo-qrs.index');
    }

    public function show(CodigoQr $codigoQr)
    {
        abort_if(Gate::denies('codigo_qr_show'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $codigoQr->load('veiculo', 'user');

        return view('admin.codigoQrs.show', compact('codigoQr'));
    }

    public function destroy(CodigoQr $codigoQr)
    {
        abort_if(Gate::denies('codigo_qr_delete'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $codigoQr->delete();

        return back();
    }

    public function massDestroy(MassDestroyCodigoQrRequest $request)
    {
        CodigoQr::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function showQrCode($codigoQr){
        //$codigoQr = md5('GabrielRodrigoDesbesell'.$codigoQr);
        return response(QRCode::text($codigoQr)->png())->header('Content-type','image/png');
    }
}
