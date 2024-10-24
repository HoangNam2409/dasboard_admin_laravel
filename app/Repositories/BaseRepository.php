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

    public function pagination(
        $column = ['*'],
        $condition = [],
        $join = [],
        $perPage = 20
    ){
        $query = $this->model->select($column)->where($condition);
        if(!empty($join)) {
            $query->join(...$join);
        }

        return $query->paginate($perPage);
    }

    public function destroy(string $id)
    {
        return $this->findById($id)->delete();
    }

    public function forceDelete(string $id)
    {
        return $this->findById($id)->forceDelete();
    }

    public function update(string $id, array $payload = [])
    {
        $user = $this->findById($id);
        return $user->update($payload);
    }

    public function create(array $payload = [])
    {
        $model = $this->model->create($payload);
        return $model->fresh(); //  phương thức fresh() sẽ tải lại bản ghi mới nhất từ cơ sở dữ liệu
    }

    public function all()
    {
        return $this->model->all();
    }

    public function findById(
        string $modelId,
        array $column = ['*'],
        array $relation = [],
    ){
        return $this->model->select($column)->with($relation)->findOrFail($modelId);
    }
}