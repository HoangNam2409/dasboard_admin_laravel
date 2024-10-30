<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserCatalogueServiceInterface as UserCatalogueService;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use App\Http\Requests\StoreUserCatalogueRequest;
use App\Http\Requests\UpdateUserRequest;

class UserCatalogueController extends Controller
{
    protected $userCatalogueService;
    protected $userCatalogueRepository;
    //
    public function __construct(
        UserCatalogueService $userCatalogueService,
        UserCatalogueRepository $userCatalogueRepository,
    )
    {
        $this->userCatalogueService = $userCatalogueService;
        $this->userCatalogueRepository = $userCatalogueRepository;
    }

    // Action index
    public function index(Request $request)
    {

        $userCatalogues = $this->userCatalogueService->paginate($request);

        // Config
        $config = [
            'js' => [
                "/template/js/plugins/switchery/switchery.js"
            ],
            'css' => [
                "/template/css/plugins/switchery/switchery.css"
            ]
        ];
        $config['seo'] = config('apps.user_catalogue');

        $template = 'user.catalogue.index';
        
        return view('dashboard.layout', compact(
            'template',
            'config',
            'userCatalogues',
        ));
    }

    // action create
    public function create()
    {
        $config['seo'] = config('apps.user_catalogue');
        $config['method'] = 'create';

        $template = 'user.catalogue.store';
        
        return view('dashboard.layout', compact(
            'template',
            'config',
        ));
    }

    // action store
    public function store(StoreUserCatalogueRequest $request)
    {
        if($this->userCatalogueService->create($request)) {
            return redirect()->route('user.catalogue.index')->with('success', 'Thêm mới nhóm thành viên thành công');
        }

        return redirect()->route('user.catalogue.index')->with('error', 'Thêm mới nhóm thành viên không thành công. Hãy thử lại');
    }

    // action edit
    public function edit(string $id)
    {
        
        $userCatalogue = $this->userCatalogueRepository->findById($id);

        $config['seo'] = config('apps.user_catalogue');
        $config['method'] = 'edit';

        $template = 'user.catalogue.store';
        return view('dashboard.layout', compact(
            'template',
            'config',
            'userCatalogue',
        ));
    }

    // action update
    public function update(StoreUserCatalogueRequest $request, string $id)
    {
        if($this->userCatalogueService->update($request, $id)) {
            return redirect()->route('user.catalogue.index')->with('success', 'Cập nhật bản ghi thành công.');
        }

        return redirect()->route('user.catalogue.index')->with('error', 'Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    // action delete
    public function delete(string $id)
    {
        $userCatalogue = $this->userCatalogueRepository->findById($id);

        $config['seo'] = config('apps.user_catalogue');
        $template = 'user.catalogue.delete';
        return view('dashboard.layout', compact(
            'template',
            'config',
            'userCatalogue',
        ));
    }

    // action destroy
    public function destroy(string $id)
    {
        if($this->userCatalogueService->destroy($id)) {
            return redirect()->route('user.catalogue.index')->with('success', 'Bạn đã xóa thành công thành viên.');
        }

        return redirect()->route('user.catalogue.index')->with('error', 'Bạn đã xóa thành viên thất bại.');
    }
}