<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\proedi\PedirConcessaoProedi;
use App\Models\Tenant;
use Faker\Generator as Faker;
use Illuminate\Validation\Rules\Unique;
use App\Tenant\Traits\TenantTrait;

$factory->define(PedirConcessaoProedi::class, function (Faker $faker) {
        
    return [
        'social_name' => $faker->name,
        'tenant_id' => factory(Tenant::class),
        'nome_empresa' => $faker->unique()->name,
        'requerimento' => 'teste.pdf',
        'projeto' => 'teste.pdf',
        'cnpj' => $faker->unique()->numberBetween(1,14),
        'nome_projetista' => 'teste.pdf',
        'cpf_projetista' => 'teste.pdf',
        'telefone_projetista' => 'teste.pdf',
        'endereco_projetista' => 'teste.pdf',
        'uf_projetista' => 'teste.pdf',
        'documento_projetista' => 'teste.pdf',
        'municipio_projetista' => 'teste.pdf',
        'inscricao_estadual' => 'teste.pdf',
        'certidao_federal' => 'teste.pdf',
        'certidao_estadual' => 'teste.pdf',
        'certidao_municipal' => 'teste.pdf',
        'certidao_trabalhista' => 'teste.pdf',
        'certidao_fgts' => 'teste.pdf',
        'ata_constituicao' => 'teste.pdf',
        'procuracao_responsavel' => 'teste.pdf',
        'rg_responsavel' => 'teste.pdf',
        'comprovante_residencia' => 'teste.pdf',
        'relatorio_gfip' => 'teste.pdf',
        'relatorio_faturamento' => 'teste.pdf',
        'documentos' => 'teste.pdf',
    ];
});
