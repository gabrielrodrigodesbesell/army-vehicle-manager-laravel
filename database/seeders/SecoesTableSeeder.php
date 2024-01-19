<?php

namespace Database\Seeders;

use App\Models\Seco;
use Illuminate\Database\Seeder;

class SecoesTableSeeder extends Seeder
{
    public function run()
    {
        Seco::create([
            'descricao' => 'Almoxarifado'
        ]);
        Seco::create([
            'descricao' => '1ª Seção'
        ]);
        Seco::create([
            'descricao' => '3º Esquadrão'
        ]);
        Seco::create([
            'descricao' => '1º Esquadrão'
        ]);
        Seco::create([
            'descricao' => '2º Esquadrão'
        ]);
        Seco::create([
            'descricao' => 'Esqd C Ap'
        ]);
        Seco::create([
            'descricao' => '2ª Seção'
        ]);
        Seco::create([
            'descricao' => '3ª Seção'
        ]);
        Seco::create([
            'descricao' => '4ª Seção'
        ]);
        Seco::create([
            'descricao' => 'Fisc Adm'
        ]);
        Seco::create([
            'descricao' => 'SFPC'
        ]);
        Seco::create([
            'descricao' => 'Setor de Pagamento'
        ]);
        Seco::create([
            'descricao' => 'SIP'
        ]);
        Seco::create([
            'descricao' => 'Relações Públicas'
        ]);
        Seco::create([
            'descricao' => 'Salc'
        ]);
        Seco::create([
            'descricao' => 'Tesouraria'
        ]);
        Seco::create([
            'descricao' => 'Saída do quartel'
        ]);
    }
}
