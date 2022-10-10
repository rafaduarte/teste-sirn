<?php

namespace App\Repository\Eloquent;

use App\Repository\Contracts\UserRepositoryInterface;
use App\User;
use Tests\Feature\App\Repository\Eloquent\UserRepositoryTest;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;

    }

    public function findAll(): array
    {
        return $this->model->get()->toArray();
    }

    public function create(array $data): object
    {
        return $this->model->create($data);   
    }

    public function update(string $id ,array $data): object
    {
        $user = $this->model->find($id);
        $user->update($data);

        $user->refresh();

        return $user;
    }
}