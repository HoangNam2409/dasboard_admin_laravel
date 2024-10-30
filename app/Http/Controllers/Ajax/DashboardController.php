<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $userService;

    //
    public function __construct(){}


    // Change Status
    public function changeStatus(Request $request)
    {
        $post = $request->except('_token');
        $serviceInterfaceNamespace = '\App\Services\\' . ucfirst($post['model']) . 'Service';
        if(class_exists($serviceInterfaceNamespace)) {
            $serviceInstance = app($serviceInterfaceNamespace);
        }

        $flag = $serviceInstance->updateStatus($post);

        return response()->json([
            'message' => 'success',
            'code' => 200,
            'flag' => $flag,
        ]);
    }

    // Change status all
    public function changeStatusAll(Request $request)
    {
        $post = $request->except('_token');
        $serviceInterfaceNamespace = '\App\Services\\' . ucfirst($post['model']) . 'Service';
        if(class_exists($serviceInterfaceNamespace)) {
            $serviceInstance = app($serviceInterfaceNamespace);
        }

        $flag = $serviceInstance->updateStatusAll($post);

        return response()->json([
            'message' => 'success',
            'code' => 200,
            'flag' => $flag,
        ]);
    }
}