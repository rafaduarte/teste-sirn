<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        Permission::create([

            'name' => 'proediadmin',
            'description' => 'Acesso às funcionalidades do PROEDI como Administrador',
        ]);

        Permission::create([

            'name' => 'usuario',
            'description' => 'Acesso às funcionalidades de criar, alterar e deleter usuários',
        ]);

        Permission::create([

            'name' => 'reports',
            'description' => 'Acesso às funcionalidades de relatórios',
        ]);

        Permission::create([

            'name' => 'mensagensadmin',
            'description' => 'Acesso às funcionalidades de enviar mensagem para as empresas',
        ]);

        Permission::create([

            'name' => 'empresa',
            'description' => 'permissões das funcionalidades das empresas',
        ]);
    }
}
