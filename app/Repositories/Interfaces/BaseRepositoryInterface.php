<?php

namespace App\Repositories\Interfaces;

/**
 * Interface BaseServiceInterface
 * @package App\Services\Interfaces
 */
interface BaseRepositoryInterface
{
    public function pagination(
        array $column = ['*'], 
        array $condition = [], 
        array $join = [],
        int $perPage = 20,
        array $extend = [],
    );
    public function destroy(string $id);
    public function update(string $id, array $payload = []);
    public function create(array $payload = []);
    public function all();
    public function findById(string $id, array $column = ['*'], array $relation = []);
}