<?php

namespace App\Repositories\Interfaces;

/**
 * Interface BaseServiceInterface
 * @package App\Services\Interfaces
 */
interface BaseRepositoryInterface
{
    public function create(array $payload = []);
    public function all();
    public function findById(string $id, array $column = ['*'], array $relation = []);
}