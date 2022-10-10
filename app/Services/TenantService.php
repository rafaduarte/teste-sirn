<?php

namespace App\Services;

use App\Models\plan;
use App\Models\Tenant;


class TenantService
{
    private $data = [];

   /* public function __construct(array $data)
    {
        $this->plan = $plan;
        $this->data = $data;  
    } */

    public function make(array $data){

        $this->data = $data;

        $tenantStore = $this->storeTenant();
        
        $user = $this->storeUser($tenantStore);

       return $user;
    }

    public function storeTenant()
    {   
        $data = $this->data;

        return Tenant::create([
                'cnpj' => $data['cnpj'],
                'name' => $data['empresa'],
                'email' => $data['email'],
    
                'subscription' => now(),
                //'expires_at' => now()->addDays(7), // o acesso expira em sete dias
            
            ]);
    }

    public function storeUser(Tenant $tenant)
    {
        $user = $tenant->users()->create([
            'name' => $this->data['empresa'],
            'email' => $this->data['email'],
            'password' => bcrypt($this->data['password']),
        ]);

        return $user;
    }
}