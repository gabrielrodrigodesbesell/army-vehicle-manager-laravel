<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Graduacao;
use App\Models\Grupo;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\Console\Input\Input;
use function PHPUnit\Framework\isNull;

class UsersController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {

        if (Gate::any(['cadastrador_soldados', 'user_access'])) {
            $agent = new \Jenssegers\Agent\Agent;
            if ($agent->isMobile()) {
                $users = User::select('grupos.descricao as grupo','users.*')->join('grupos', 'grupos.id', '=', 'grupo_id')->orderByRaw('name DESC')->get();                
                return view('admin.users.mobile.index', compact('users'));
            } else {
                if ($request->ajax()) {
                    if (!Gate::denies('cadastrador_soldados') && auth()->user()->grupo_id != NULL) {
                        $query = User::with(['roles', 'grupo', 'graduacao'])->select(sprintf('%s.*', (new User())->table))->where('grupo_id', '=', auth()->user()->grupo_id);
                    } else {
                        $query = User::with(['roles', 'grupo', 'graduacao'])->select(sprintf('%s.*', (new User())->table));
                    }
                    $table = Datatables::of($query);

                    $table->addColumn('placeholder', '&nbsp;');
                    $table->addColumn('actions', '&nbsp;');

                    $table->editColumn('actions', function ($row) {
                        $viewGate = 'user_show';
                        $editGate = 'user_edit';
                        $deleteGate = 'user_delete';
                        $crudRoutePart = 'users';

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
                    $table->editColumn('name', function ($row) {
                        return $row->name ? $row->name : '';
                    });
                    $table->editColumn('email', function ($row) {
                        return $row->email ? $row->email : '';
                    });
                    $table->editColumn('two_factor', function ($row) {
                        return '<input type="checkbox" disabled ' . ($row->two_factor ? 'checked' : null) . '>';
                    });
                    $table->editColumn('approved', function ($row) {
                        return '<input type="checkbox" disabled ' . ($row->approved ? 'checked' : null) . '>';
                    });
                    $table->editColumn('roles', function ($row) {
                        $labels = [];
                        foreach ($row->roles as $role) {
                            $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
                        }

                        return implode(' ', $labels);
                    });
                    $table->editColumn('cpf', function ($row) {
                        return $row->cpf ? $row->cpf : '';
                    });
                    $table->addColumn('grupo_descricao', function ($row) {
                        return $row->grupo ? $row->grupo->descricao : '';
                    });

                    $table->addColumn('graduacao_descricao', function ($row) {
                        return $row->graduacao ? $row->graduacao->descricao : '';
                    });

                    $table->editColumn('nomemae', function ($row) {
                        return $row->nomemae ? $row->nomemae : '';
                    });

                    $table->rawColumns(['actions', 'placeholder', 'two_factor', 'approved', 'roles', 'grupo', 'graduacao']);

                    return $table->make(true);
                }

                return view('admin.users.index');
            }
        } else {
            abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $roles = Role::orderBy('title','ASC')->pluck('title', 'id');

        $grupos = Grupo::orderBy('descricao','ASC')->pluck('descricao', 'id')->prepend(trans('global.pleaseSelect'), '');

        $graduacaos = Graduacao::orderBy('descricao','ASC')->pluck('descricao', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.users.create', compact('graduacaos', 'grupos', 'roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        if ($request->input('foto', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('foto'))))->toMediaCollection('foto');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }
        if ($request->input('acao') == "iopessoa") {
            return redirect()->to(url('/admin/io-pessoas/create/?pessoa=' . $user->id));
        } else {
            return redirect()->route('admin.users.index');
        }
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $roles = Role::orderBy('title','ASC')->pluck('title', 'id');

        $grupos = Grupo::orderBy('descricao','ASC')->pluck('descricao', 'id')->prepend(trans('global.pleaseSelect'), '');

        $graduacaos = Graduacao::orderBy('descricao','ASC')->pluck('descricao', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user->load('roles', 'grupo', 'graduacao');

        return view('admin.users.edit', compact('graduacaos', 'grupos', 'roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        if ($request->input('foto', false)) {
            if (!$user->foto || $request->input('foto') !== $user->foto->file_name) {
                if ($user->foto) {
                    $user->foto->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('foto'))))->toMediaCollection('foto');
            }
        } elseif ($user->foto) {
            $user->foto->delete();
        }

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $user->load('roles', 'grupo', 'graduacao');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_create') && Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $model         = new User();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
