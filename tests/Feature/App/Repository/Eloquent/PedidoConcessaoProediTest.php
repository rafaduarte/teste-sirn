<?php

namespace Tests\Feature\App\Repository\Eloquent;

use App\Models\proedi\PedirConcessaoProedi;
use App\Models\Tenant;
use App\Repository\Contracts\ConcessaoProediInterface;
use App\Repository\Eloquent\ConcessaoProediRepository;
use App\Tenant\Traits\TenantTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PedidoConcessaoProediTest extends TestCase
{
    use RefreshDatabase, TenantTrait;

    protected $repository;

    protected function setUp(): void
    {
        $this->repository = new ConcessaoProediRepository(new PedirConcessaoProedi());

        parent::setUp();
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(ConcessaoProediInterface::class,
        $this->repository);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_find_all_empty()
    {
        //$response = $this->get('/');

        //$response->assertStatus(200);
        
        $repository = new ConcessaoProediRepository(new PedirConcessaoProedi());
        $response = $repository->findAll();

        $this->assertIsArray($response);
        $this->assertCount(0, $response);

        //$this->assertTrue(true);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_find_all()
    {
        //$response = $this->get('/');

        //$response->assertStatus(200);

        factory(PedirConcessaoProedi::class, 20)->create();
        
        $repository = new ConcessaoProediRepository(new PedirConcessaoProedi());
        $response = $repository->findAll();

        //$this->assertIsArray($response);
        $this->assertCount(20, $response);

        //$this->assertTrue(true);
    }
    
    public function test_create()
    {
        $tenant = factory(Tenant::class)->create();
        
        $data = [
        'tenant_id' => $tenant->id,
        'social_name' => 'rafael duarte',
        'nome_empresa' => 'rafael corporation',
        'requerimento' => 'teste.pdf',
        'projeto' => 'teste.pdf',
        'cnpj' => 23456789765436,
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

        $response = $this->repository->create($data);

        $this->assertNotNull($response);
        $this->assertIsObject($response);
        $this->assertDatabaseHas('pedir_concessao_proedis', [
            'social_name' => 'rafael duarte',
        ]);
    }
}
