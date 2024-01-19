<?php

namespace App\Http\Controllers\Admin;

use App\Models\IoPessoa;
use App\Models\IoVeiculo;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    const limit = 10;
    public function index()
    {
        $agent = new \Jenssegers\Agent\Agent;
        if ($agent->isMobile()) {
            $ioVeiculos = IoVeiculo::with(['responsavel_user', 'secao', 'veiculo'])->take(self::limit)->orderByRaw('id DESC')->get();
            $ioPessoas = IoPessoa::with(['responsavel_user', 'user', 'secao'])->take(self::limit)->orderByRaw('id DESC')->get();
            return view('home_mobile', compact('ioVeiculos','ioPessoas'));
        } else {
            $io = [];

            $io['pessoas'] = IoPessoa::select('io_pessoas.*', 'users.name as responsavel', 'user.name', 'secoes.descricao as destino')
                ->join('users', 'users.id', '=', 'io_pessoas.responsavel_user_id')
                ->join('secoes', 'secoes.id', '=', 'io_pessoas.secao_id')
                ->join('users as user', 'user.id', '=', 'io_pessoas.user_id')
                ->take(self::limit)
                ->orderByRaw('io_pessoas.created_at DESC')
                ->get();

            $io['veiculos'] = IoVeiculo::join('users', 'users.id', '=', 'io_veiculos.responsavel_user_id')
                ->join('secoes', 'secoes.id', '=', 'io_veiculos.secao_id')
                ->join('veiculos', 'veiculos.id', '=', 'io_veiculos.veiculo_id')
                ->take(self::limit)
                ->orderByRaw('io_veiculos.created_at DESC')
                ->get();
            return view('home', compact('io'));
        }
    }
}
