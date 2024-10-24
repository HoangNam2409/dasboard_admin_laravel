<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    protected $userService;
    protected $provinceRepository;
    //
    public function __construct(
        UserService $userService,
        ProvinceRepository $provinceRepository
    )
    {
        $this->userService = $userService;
        $this->provinceRepository = $provinceRepository;
    }

    public function index()
    {

        $users = $this->userService->paginate();

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

        $template = 'user.index';
        
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
        $config = [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                '/template/library/location.js'
            ]
        ];
        $config['seo'] = config('apps.user');

        $template = 'user.create';
        
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

        return redirect()->route('user.index')->with('success', 'Thêm mới bản ghi không thành công. Hãy thử lại');
    }
}