<?php

namespace Database\Seeders;

use App\Models\Graduacao;
use Illuminate\Database\Seeder;

class GraduacaoTableSeeder extends Seeder
{
    public function run()
    {
        Graduacao::create([
            'descricao' => '1º Sargento'
        ]);
        Graduacao::create([
            'descricao' => '1º Tenente'
        ]);
        Graduacao::create([
            'descricao' => '2º Sargento'
        ]);
        Graduacao::create([
            'descricao' => '2º Tenente'
        ]);
        Graduacao::create([
            'descricao' => '3º Sargento'
        ]);
        Graduacao::create([
            'descricao' => 'Admin'
        ]);
        Graduacao::create([
            'descricao' => 'Cabo'
        ]);
        Graduacao::create([
            'descricao' => 'Capitão'
        ]);
        Graduacao::create([
            'descricao' => 'Coronel'
        ]);
        Graduacao::create([
            'descricao' => 'Major'
        ]);
        Graduacao::create([
            'descricao' => 'Soldado'
        ]);
        Graduacao::create([
            'descricao' => 'Tenente Coronel'
        ]);
    }
}
