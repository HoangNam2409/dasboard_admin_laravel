<?php

namespace App\Services;

use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    // paginate
    public function paginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['publish'] = $request->integer('publish');
        $perPage = $request->integer('perpage');
        $extend['path'] = 'user/index';

        $users = $this->userRepository->pagination(['id', 'email', 'name', 'phone', 'address', 'publish'], $condition, [], $perPage, $extend);
        return $users;
    }

    // Create
    public function create($request)
    {
        DB::beginTransaction();
        try {

            $payload = $request->except('_token', 'send', 're_password');
            $payload['birthday'] = $this->convertBirthdayDate($payload['birthday']);
            $payload['password'] = Hash::make($payload['password']);
            
            $this->userRepository->create($payload);
            
            DB::commit();
            return true;
        } catch(\Exception $e) {
            DB::rollBack();

            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }


    // Update
    public function update($request, $id)
    {
        DB::beginTransaction();

        try {
            $payload = $request->except('_token', 'send');
            $payload['birthday'] = $this->convertBirthdayDate($payload['birthday']);

            $this->userRepository->update($id, $payload);

            DB::commit();
            return true;
        } catch(\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die();
            return false;
        }
    }

    // Destroy
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $this->userRepository->destroy($id);

            DB::commit();
            return true;
        } catch(\Exception $e) {
            DB::rollBack();
            $e->getMessage();
            return false;
        }
    }

    // Change Status
    public function updateStatus(array $post = [])
    {
        DB::beginTransaction();

        try {
            $payload[$post['field']] = ($post['value'] == 0 ? 1 : 0);

            $this->userRepository->update($post['modelId'], $payload);

            DB::commit();
            return true;
        } catch(\Exception $e) {
            DB::rollBack();
            $e->getMessage();
            return false;
        }
    }

    // Change Status All
    public function updateStatusAll(array $post = [])
    {
        DB::beginTransaction();

        $payload[$post['field']] = $post['value'];
        $this->userRepository->updateByWhereIn('id', $post['id'], $payload);

        try {
            DB::commit();
            return true;
        } catch(\Exception $e) {
            DB::rollBack();
            $e->getMessage();
            return false;
        }
    }


    // convertBirthdayDate
    private function convertBirthdayDate($birthday)
    {
        $carbonDate = Carbon::createFromFormat('Y-m-d', $birthday);
        return $carbonDate->format('Y-m-d H:i:s');
    }
}