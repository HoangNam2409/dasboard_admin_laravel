<?php

namespace App\Repositories\Interfaces;

/**
 * Interface BaseServiceInterface
 * @package App\Services\Interfaces
 */
interface BaseRepositoryInterface
{
    public function pagination(
        array $columns = ['*'], 
        array $condition = [], 
        array $join = [],
        int $perPage = 20,
        array $extend = [],
        array $relations = [],
    );
    public function destroy(string $id);
    public function update(string $id, array $payload = []);
    public function create(array $payload = []);
    public function all();
    public function findById(string $id, array $column = ['*'], array $relation = []);
    public function updateByWhereIn(string $whereInField = '', array $whereIn = [], array $payload = []);
}