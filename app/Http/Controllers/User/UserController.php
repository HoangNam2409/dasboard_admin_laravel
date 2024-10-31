<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    protected $userService;
    protected $provinceRepository;
    protected $userRepository;
    //
    public function __construct(
        UserService $userService,
        ProvinceRepository $provinceRepository,
        UserRepository $userRepository,
    )
    {
        $this->userService = $userService;
        $this->provinceRepository = $provinceRepository;
        $this->userRepository = $userRepository;
    }

    // Action index
    public function index(Request $request)
    {

        $users = $this->userService->paginate($request);

        // Config
        $config = [
            'js' => [
                "/template/js/plugins/switchery/switchery.js"
            ],
            'css' => [
                "/template/css/plugins/switchery/switchery.css"
            ]
        ];
        $config['seo'] = config('apps.user');

        $template = 'user.user.index';
        
        return view('dashboard.layout', compact(
            'template',
            'config',
            'users',
        ));
    }

    // action create
    public function create()
    {
        $provinces = $this->provinceRepository->all();

        // Config
        $config = $this->configData();
        $config['seo'] = config('apps.user');
        $config['method'] = 'create';

        $template = 'user.user.store';
        
        return view('dashboard.layout', compact(
            'template',
            'config',
            'provinces',
        ));
    }

    // action store
    public function store(StoreUserRequest $request)
    {
        if($this->userService->create($request)) {
            return redirect()->route('user.index')->with('success', 'Thêm mới bản ghi thành công');
        }

        return redirect()->route('user.index')->with('error', 'Thêm mới bản ghi không thành công. Hãy thử lại');
    }

    // action edit
    public function edit(string $id)
    {
        $provinces = $this->provinceRepository->all();
        $user = $this->userRepository->findById($id);

        // Config
        $config = $this->configData();
        $config['seo'] = config('apps.user');
        $config['method'] = 'edit';

        $template = 'user.user.store';
        return view('dashboard.layout', compact(
            'template',
            'config',
            'provinces',
            'user',
        ));
    }

    // action update
    public function update(UpdateUserRequest $request, string $id)
    {
        if($this->userService->update($request, $id)) {
            return redirect()->route('user.index')->with('success', 'Cập nhật bản ghi thành công.');
        }

        return redirect()->route('user.index')->with('error', 'Cập nhật bản ghi không thành công. Hãy thử lại');
    }

    // action delete
    public function delete(string $id)
    {
        $user = $this->userRepository->findById($id);

        $config['seo'] = config('apps.user');
        $template = 'user.user.delete';
        return view('dashboard.layout', compact(
            'template',
            'config',
            'user',
        ));
    }

    // action destroy
    public function destroy(string $id)
    {
        if($this->userService->destroy($id)) {
            return redirect()->route('user.index')->with('success', 'Bạn đã xóa thành công thành viên.');
        }

        return redirect()->route('user.index')->with('error', 'Bạn đã xóa thành viên thất bại.');
    }

    private function configData()
    {
        return [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                '/template/library/location.js',
                '/template/plugins/ckfinder_2/ckfinder.js',
                '/template/library/finder.js',
            ]
        ];
    }
}