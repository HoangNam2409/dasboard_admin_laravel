<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\PostCatalogueServiceInterface as PostCatalogueService;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;
use App\Http\Requests\StorePostCatalogueRequest;
use App\Http\Requests\UpdatePostCatalogueRequest;

class PostCatalogueController extends Controller
{
    protected $postCatalogueService;
    protected $postCatalogueRepository;
    //
    public function __construct(
        PostCatalogueService $postCatalogueService,
        PostCatalogueRepository $postCatalogueRepository,
    )
    {
        $this->postCatalogueService = $postCatalogueService;
        $this->postCatalogueRepository = $postCatalogueRepository;
    }

    // Action index
    public function index(Request $request)
    {

        $postCatalogues = $this->postCatalogueService->paginate($request);

        // Config
        $config = [
            'js' => [
                "/template/js/plugins/switchery/switchery.js"
            ],
            'css' => [
                "/template/css/plugins/switchery/switchery.css"
            ]
        ];
        $config['seo'] = config('apps.postCatalogues');

        $template = 'post.catalogue.index';
        
        return view('dashboard.layout', compact(
            'template',
            'config',
            'postCatalogues',
        ));
    }

    // action create
    public function create()
    {
        $config = $this->configData();
        $config['seo'] = config('apps.postCatalogues');
        $config['method'] = 'create';

        $template = 'post.catalogue.store';
        
        return view('dashboard.layout', compact(
            'template',
            'config',
        ));
    }

    // action store
    public function store(StorePostCatalogueRequest $request)
    {
        if($this->postCatalogueService->create($request)) {
            return redirect()->route('post.catalogue.index')->with('success', 'Thêm mới nhóm thành viên thành công');
        }

        return redirect()->route('post.catalogue.index')->with('error', 'Thêm mới nhóm thành viên không thành công. Hãy thử lại');
    }

    // action edit
    public function edit(string $id)
    {
        
        $postCatalogue = $this->postCatalogueRepository->findById($id);

        $config = $this->configData();
        $config['seo'] = config('apps.postCatalogues');
        $config['method'] = 'edit';

        $template = 'post.catalogue.store';
        return view('dashboard.layout', compact(
            'template',
            'config',
            'postCatalogue',
        ));
    }

    // action update
    public function update(UpdatePostCatalogueRequest $request, string $id)
    {
        if($this->postCatalogueService->update($request, $id)) {
            return redirect()->route('post.catalogue.index')->with('success', 'Cập nhật bản ghi thành công.');
        }

        return redirect()->route('post.catalogue.index')->with('error', 'Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    // action delete
    public function delete(string $id)
    {
        $postCatalogue = $this->postCatalogueRepository->findById($id);

        $config['seo'] = config('apps.postCatalogues');
        $template = 'post.catalogue.delete';
        return view('dashboard.layout', compact(
            'template',
            'config',
            'postCatalogue',
        ));
    }

    // action destroy
    public function destroy(string $id)
    {
        if($this->postCatalogueService->destroy($id)) {
            return redirect()->route('post.catalogue.index')->with('success', 'Bạn đã xóa thành công thành viên.');
        }

        return redirect()->route('post.catalogue.index')->with('error', 'Bạn đã xóa thành viên thất bại.');
    }

    private function configData() 
    {
        return [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
            ],
            'js' => [
                '/template/plugins/ckfinder_2/ckfinder.js',
                '/template/library/finder.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
            ]
        ];
    }
}