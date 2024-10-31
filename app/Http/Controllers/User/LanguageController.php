<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\LanguageServiceInterface as LanguageService;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Http\Requests\UpdateUserRequest;

class LanguageController extends Controller
{
    protected $languageService;
    protected $languageRepository;
    //
    public function __construct(
        LanguageService $languageService,
        LanguageRepository $languageRepository,
    )
    {
        $this->languageService = $languageService;
        $this->languageRepository = $languageRepository;
    }

    // Action index
    public function index(Request $request)
    {

        $languages = $this->languageService->paginate($request);

        // Config
        $config = [
            'js' => [
                "/template/js/plugins/switchery/switchery.js"
            ],
            'css' => [
                "/template/css/plugins/switchery/switchery.css"
            ]
        ];
        $config['seo'] = config('apps.language');

        $template = 'language.index';
        
        return view('dashboard.layout', compact(
            'template',
            'config',
            'languages',
        ));
    }

    // action create
    public function create()
    {
        $config = $this->configData();
        $config['seo'] = config('apps.language');
        $config['method'] = 'create';

        $template = 'language.store';
        
        return view('dashboard.layout', compact(
            'template',
            'config',
        ));
    }

    // action store
    public function store(StoreLanguageRequest $request)
    {
        if($this->languageService->create($request)) {
            return redirect()->route('language.index')->with('success', 'Thêm mới nhóm thành viên thành công');
        }

        return redirect()->route('language.index')->with('error', 'Thêm mới nhóm thành viên không thành công. Hãy thử lại');
    }

    // action edit
    public function edit(string $id)
    {
        
        $language = $this->languageRepository->findById($id);

        $config = $this->configData();
        $config['seo'] = config('apps.language');
        $config['method'] = 'edit';

        $template = 'language.store';
        return view('dashboard.layout', compact(
            'template',
            'config',
            'language',
        ));
    }

    // action update
    public function update(UpdateLanguageRequest $request, string $id)
    {
        if($this->languageService->update($request, $id)) {
            return redirect()->route('language.index')->with('success', 'Cập nhật bản ghi thành công.');
        }

        return redirect()->route('language.index')->with('error', 'Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    // action delete
    public function delete(string $id)
    {
        $language = $this->languageRepository->findById($id);

        $config['seo'] = config('apps.language');
        $template = 'language.delete';
        return view('dashboard.layout', compact(
            'template',
            'config',
            'language',
        ));
    }

    // action destroy
    public function destroy(string $id)
    {
        if($this->languageService->destroy($id)) {
            return redirect()->route('language.index')->with('success', 'Bạn đã xóa thành công thành viên.');
        }

        return redirect()->route('language.index')->with('error', 'Bạn đã xóa thành viên thất bại.');
    }

    private function configData() 
    {
        return [
            'js' => [
                '/template/plugins/ckfinder_2/ckfinder.js',
                '/template/library/finder.js',
            ]
        ];
    }
}