<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::first();
             
        $tenant->users()->create([
            'name' => 'Coordenadoria de Desenvolvimento Economico',
            'email' => 'codit.sedecrn@gmail.com',
            'password' => bcrypt('12345678rd'),
        ]);
    }
}
