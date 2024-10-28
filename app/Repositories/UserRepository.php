<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\BaseRepository;


/**
 * Class UserService
 * @package App\Services
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $model;
    
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function pagination(array $columns = ['*'], array $condition = [], array $join = [], int $perPage = 20, array $extend = [])
    {
        $query = $this->model->select($columns)->where(function($query) use ($condition) {
            if(isset($condition['keyword']) && !empty($condition['keyword'])) {
                    $query->where('name', 'LIKE', '%'.$condition['keyword'].'%')
                        ->orWhere('email', 'LIKE', '%'.$condition['keyword'].'%')
                        ->orWhere('phone', 'LIKE', '%'.$condition['keyword'].'%')
                        ->orWhere('address', 'LIKE', '%'.$condition['keyword'].'%'); 
            }

            if(isset($condition['publish']) && $condition['publish'] != -1) {
                $query->where('publish', '=', $condition['publish']);
            }

            return $query;
        });

        if(!empty($join)) {
            $query->join(...$join);
        }

        return $query->paginate($perPage)->withQueryString()->withPath(env('APP_URL') . $extend['path']);
    }
}