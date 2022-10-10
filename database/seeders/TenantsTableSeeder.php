<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tenant::create([
            'social_name' => 'sedec',
            'name' => 'sedecrn',            
            'cnpj' => 0000000000000000,
            'inscricao_estadual' => '00000000',
            'endereco_empresa' => 'centro administrativo',
            'municipio' => 'Natal',
            'uf' => 'RN',
            'cep' => '59064901',
            'telefone' => '8432321750',
            'email' => 'codit.sedecrn@gmail.com',
            'inicio_atividade' => '2022-05-12',
            'tipo_empresa' => 'secretaria',
            'nome_empresario' => 'Olavo',
            'cpf' => '00000000000',
            'endereco_empresario' => ' Av. Senador Salgado Filho',
            'municipio_empresario' => 'Natal',
            'uf_empresario' => 'RN',
            'cep_empresario' => '59064901',
            'telefone_empresario' => '8432321705',
            'email_empresario' => 'sedec@rn.gov.br',
        ]);
    }
}
