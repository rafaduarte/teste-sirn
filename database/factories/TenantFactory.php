<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Tenant;
use Faker\Generator as Faker;




$factory->define(Tenant::class, function (Faker $faker) {
    
$tenant = app(Tenant::class);

    return [
            'social_name' => $faker->name,
            'name' => $faker->name,            
            'cnpj' => $tenant->cnpjRandom(14),
            'inscricao_estadual' => $faker->name,
            'endereco_empresa' => $faker->name,
            'municipio' => $faker->name,
            'uf' => $faker->name,
            'cep' => $faker->unique()->numberBetween(1,14),
            'telefone' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'inicio_atividade' => $faker->date(),
            'tipo_empresa' => $faker->name,
            'nome_empresario' => $faker->name,
            'cpf' => $faker->unique(true)->numberBetween(1,20),
            'endereco_empresario' => $faker->name,
            'municipio_empresario' => $faker->name,
            'uf_empresario' => $faker->name,
            'cep_empresario' => $faker->unique()->numberBetween(1,14),
            'telefone_empresario' => $faker->name,
            'email_empresario' => $faker->unique()->safeEmail,
    ];
});
