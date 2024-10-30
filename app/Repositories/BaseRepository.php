<?php

namespace App\Repositories;

use App\Models\District;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;


/**
 * Class BaseService
 * @package App\Services
 */
class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->$model = $model;
    }

    // Pagination
    public function pagination(
        array $columns = ['*'],
        array $condition = [],
        array $join = [],
        int $perPage = 20,
        array $extend = [],
        array $relations = [],
    ){
        $query = $this->model->select($columns)->where(function($query) use ($condition) {
            if(isset($condition['keyword']) && !empty($condition['keyword'])) {
                $query->where('name', 'LIKE', '%'.$condition['keyword'].'%');
            }

            if(isset($condition['publish']) && $condition['publish'] != 0) {
                $query->where('publish', '=', $condition['publish']);
            }

            return $query;
        });

        if(isset($relations) && !empty($relations)) {
            foreach($relations as $relation) {
                $query->withCount($relation);
            }
        }

        if(!empty($join)) {
            $query->join(...$join);
        }

        return $query->paginate($perPage)->withQueryString()->withPath(env('APP_URL') . $extend['path']);
    }

    // Destroy
    public function destroy(string $id)
    {
        return $this->findById($id)->delete();
    }


    // Force Delete
    public function forceDelete(string $id)
    {
        return $this->findById($id)->forceDelete();
    }


    // Update
    public function update(string $id, array $payload = [])
    {
        $user = $this->findById($id);
        return $user->update($payload);
    }

    public function updateByWhereIn(string $whereInField = '', array $whereIn = [], array $payload = [])
    {
        return $this->model->whereIn($whereInField, $whereIn)->update($payload);
    }


    // Create
    public function create(array $payload = [])
    {
        $model = $this->model->create($payload);
        return $model->fresh(); //  phương thức fresh() sẽ tải lại bản ghi mới nhất từ cơ sở dữ liệu
    }


    // All
    public function all()
    {
        return $this->model->all();
    }


    // Find By Id
    public function findById(
        string $modelId,
        array $column = ['*'],
        array $relation = [],
    ){
        return $this->model->select($column)->with($relation)->findOrFail($modelId);
    }
}