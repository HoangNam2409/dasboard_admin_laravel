<?php

namespace App\Services;

use App\Services\Interfaces\LanguageServiceInterface;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class LanguageService
 * @package App\Services
 */
class LanguageService implements LanguageServiceInterface
{
    protected $languageRepository;

    public function __construct(
        LanguageRepository $languageRepository,
    ){
        $this->languageRepository = $languageRepository;
    }

    // paginate
    public function paginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['publish'] = $request->integer('publish');
        $perPage = $request->integer('perpage');
        $extend['path'] = 'language/index';

        $languages = $this->languageRepository->pagination(['id', 'name', 'canonical', 'publish'], $condition, [], $perPage, $extend, []);
        return $languages;
    }

    // Create
    public function create($request)
    {
        DB::beginTransaction();
        try {

            $payload = $request->except('_token', 'send');
            $payload['user_id'] = Auth::id();
            
            $this->languageRepository->create($payload);
            
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

            $this->languageRepository->update($id, $payload);

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
            $this->languageRepository->destroy($id);

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

            $this->languageRepository->update($post['modelId'], $payload);

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
        
        $this->languageRepository->updateByWhereIn('id', $post['id'], $payload);

        try {
            DB::commit();
            return true;
        } catch(\Exception $e) {
            DB::rollBack();
            $e->getMessage();
            return false;
        }
    }
}