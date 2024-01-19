<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssetsHistory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssetsHistoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('assets_history_access'), Response::HTTP_FORBIDDEN, trans('global.http_error_403'));

        $assetsHistories = AssetsHistory::with(['asset', 'status', 'location', 'assigned_user'])->get();

        return view('admin.assetsHistories.index', compact('assetsHistories'));
    }
}
