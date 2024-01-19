<?php

namespace Database\Seeders;

use App\Models\Grupo;
use Illuminate\Database\Seeder;

class GrupoTableSeeder extends Seeder
{
    public function run()
    {
        Grupo::create([
            'descricao' => 'Militar do 14º RC Mec',
            'externo' => '0'
        ]);
        Grupo::create([
            'descricao' => 'Admin',
            'externo' => '0'
        ]);
        Grupo::create([
            'descricao' => 'Militar de outra OM',
            'externo' => '0'
        ]);
        Grupo::create([
            'descricao' => 'Civil',
            'externo' => '1'
        ]);
        Grupo::create([
            'descricao' => 'Dependentes de militar',
            'externo' => '0'
        ]);
        Grupo::create([
            'descricao' => 'Pensionista',
            'externo' => '0'
        ]);
        Grupo::create([
            'descricao' => 'Inativo',
            'externo' => '0'
        ]);
        Grupo::create([
            'descricao' => 'Fornecedor',
            'externo' => '1'
        ]);
    }
}
