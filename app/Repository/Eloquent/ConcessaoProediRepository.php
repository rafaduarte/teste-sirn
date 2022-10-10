<?php

namespace App\Repository\Eloquent;

use App\Models\proedi\PedirConcessaoProedi;
use App\Repository\Contracts\ConcessaoProediInterface;
use Illuminate\Support\Facades\DB;

class ConcessaoProediRepository implements ConcessaoProediInterface
{    
    protected $model;

    public function __construct(PedirConcessaoProedi $concessao)
    {
        $this->model = $concessao;

    }

    public function findAll(): array
    {
        return $this->model->get()->toArray();
    }

    public function create(array $data): object
    {
        return $this->model->create($data);   
    }
}