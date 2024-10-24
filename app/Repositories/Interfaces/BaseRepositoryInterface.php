<?php

namespace App\Repositories\Interfaces;

/**
 * Interface BaseServiceInterface
 * @package App\Services\Interfaces
 */
interface BaseRepositoryInterface
{
    public function pagination($column = ['*'], $condition = [], $join = [], $perPage = 20);
    public function destroy(string $id);
    public function update(string $id, array $payload = []);
    public function create(array $payload = []);
    public function all();
    public function findById(string $id, array $column = ['*'], array $relation = []);
}