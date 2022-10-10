<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        
        $permissions_codit = Permission::where('name', '<>', 'empresa')->get();
        $permissions_gabinete = Permission::where('name', '<>', 'usuario')
                                                    ->where('name', '<>', 'empresa')->get();
        $permissions_empresa = Permission::where('name', '=', 'empresa')->get();
        
        Profile::create([
            'name' => 'codit',
            'description' => 'Coordenadoria de Desenvolvimento Industrial do RN',
        ]);

        Profile::create([
            'name' => 'gabinete',
            'description' => 'Gabinete da SEDEC RN',
        ]);

        Profile::create([
            'name' => 'empresa',
            'description' => 'perfil atribuído as empresas',
        ]);

        $setor_codit = Profile::where('name', '=', 'codit')->first();

        foreach($permissions_codit as $permission) {
            $permission->profiles()->attach($setor_codit);
        }

        $setor_gabinete = Profile::where('name', '=', 'gabinete')->first();

        foreach($permissions_gabinete as $gabinete) {
            $gabinete->profiles()->attach($setor_gabinete);
        }

        $setor_empresa = Profile::where('name', '=', 'empresa')->first();

        foreach($permissions_empresa as $empresa) {
            $empresa->profiles()->attach($setor_empresa);
        }
    }
}
