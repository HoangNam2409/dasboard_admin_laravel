<?php

namespace App\Services;

use App\Services\Interfaces\UserCatalogueServiceInterface;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService
 * @package App\Services
 */
class UserCatalogueService implements UserCatalogueServiceInterface
{
    protected $userCatalogueRepository;
    protected $userRepository;

    public function __construct(
        UserCatalogueRepository $userCatalogueRepository,
        UserRepository $userRepository
    ){
        $this->userCatalogueRepository = $userCatalogueRepository;
        $this->userRepository = $userRepository;
    }

    // paginate
    public function paginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['publish'] = $request->integer('publish');
        $perPage = $request->integer('perpage');
        $extend['path'] = 'user/catalogue/index';

        $userCatalogues = $this->userCatalogueRepository->pagination(['id', 'name', 'description', 'publish'], $condition, [], $perPage, $extend, ['users']);
        return $userCatalogues;
    }

    // Create
    public function create($request)
    {
        DB::beginTransaction();
        try {

            $payload = $request->except('_token', 'send');
            
            $this->userCatalogueRepository->create($payload);
            
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

            $this->userCatalogueRepository->update($id, $payload);

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
            $this->userCatalogueRepository->destroy($id);

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
            $payload[$post['field']] = ($post['value'] == 1 ? 2 : 1);

            $this->userCatalogueRepository->update($post['modelId'], $payload);
            $this->changeUserStatus($post, $payload[$post['field']]);

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
        
        $this->userCatalogueRepository->updateByWhereIn('id', $post['id'], $payload);
        $this->changeUserStatus($post, $post['value']);

        try {
            DB::commit();
            return true;
        } catch(\Exception $e) {
            DB::rollBack();
            $e->getMessage();
            return false;
        }
    }

    // Change User Status
    private function changeUserStatus($post, $value) 
    {
        DB::beginTransaction();

        try {

            $array = [];
            if(isset($post['modelId'])) {
                $array[] = $post['modelId'];
            } else {
                $array = $post['id'];
            }

            $payload[$post['field']] = $value;

            $this->userRepository->updateByWhereIn('user_catalogue_id', $array, $payload);

            DB::commit();
            return true;

        } catch (\Exception $e) {
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