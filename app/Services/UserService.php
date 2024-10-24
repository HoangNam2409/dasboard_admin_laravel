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

    private function convertBirthdayDate($birthday)
    {
        $carbonDate = Carbon::createFromFormat('Y-m-d', $birthday);
        return $carbonDate->format('Y-m-d H:i:s');
    }
}