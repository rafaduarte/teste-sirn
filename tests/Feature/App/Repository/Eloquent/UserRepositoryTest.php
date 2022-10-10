<?php

namespace Tests\Feature\App\Repository\Eloquent;

use App\Models\Tenant;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Repository\Eloquent\UserRepository;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $repository;

    protected function setUp(): void
    {
        $this->repository = new UserRepository(new User());
        
        parent::setUp();
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(UserRepositoryInterface::class,
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
        
        $response = $this->repository->findAll();

        $this->assertIsArray($response);
        $this->assertCount(0, $response);

        //$response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_find_all()
    {
        
        //User::factory()->count(10)->create();

        //factory(Tenant::class, 1)->create();

        factory(User::class, 10)->create();

        $response = $this->repository->findAll();

        //$this->assertIsArray($response);
        $this->assertCount(10, $response);

        //$response->assertStatus(200);
    }

    public function test_create()
    {
        $tenant = factory(Tenant::class)->create();
        
        $data = [
            'tenant_id' => $tenant->id,
            'name' => 'Rafael Duarte',
            'email' => 'rafaelduartedelimaa@gmail.com',
            'password' => bcrypt('123456'),
        ];

        $response = $this->repository->create($data);

        $this->assertNotNull($response);
        $this->assertIsObject($response);
        $this->assertDatabaseHas('users', [
            'email' => 'rafaelduartedelimaa@gmail.com',
        ]);
    }
    
    public function test_create_exception()
    {       
        $this->expectException(QueryException::class);

        $tenant = factory(Tenant::class)->create();
        
        $data = [
            'tenant_id' => $tenant->id,
            'name' => 'Rafael Duarte',
            'password' => bcrypt('123456'),
        ];        

        $response = $this->repository->create($data);       
    }

    public function test_update()
    {
        $user  = factory(User::class)->create();

        $data = [
            'name' => 'new name',
        ];
        
       $response = $this->repository->update($user->id, $data);

       $this->assertNotNull($response);
       $this->assertIsObject($response);
       $this->assertDatabaseHas('users', [
        'name' => 'new name',
       ]);
    }
}
