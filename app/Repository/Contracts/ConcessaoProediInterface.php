<?php

namespace App\Repository\Contracts;

interface ConcessaoProediInterface
{
    public function findAll(): array;
    public function create(array $data): object;
}