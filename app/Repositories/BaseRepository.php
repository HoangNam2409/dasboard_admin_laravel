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

    public function all()
    {
        return $this->model->all();
    }
}