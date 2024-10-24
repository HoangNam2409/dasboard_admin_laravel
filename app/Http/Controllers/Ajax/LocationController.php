<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Repositories\Interfaces\DistrictRepositoryInterface as DistrictRepository;
use App\Repositories\Interfaces\WardRepositoryInterface as WardRepository;

class LocationController extends Controller
{
    protected $provinceRepository;
    protected $districtRepository;
    protected $wardRepository;

    public function __construct(
        ProvinceRepository $provinceRepository,
        DistrictRepository $districtRepository,
        WardRepository $wardRepository
    ){
        $this->provinceRepository = $provinceRepository;
        $this->districtRepository = $districtRepository;
        $this->wardRepository = $wardRepository;
    }

    public function getLocation(Request $request)
    {
        $get = $request->input();

        if($get['target']  == 'districts') {
            $province = $this->provinceRepository->findById($get['data']['location_id'], ['code', 'name'], ['districts']);
            $result = [
                'locations'=>$province->districts,
                'root' => '[Chọn Quận/Huyện]',
            ];
        } else if($get['target'] == 'wards') {
            $district = $this->districtRepository->findById($get['data']['location_id'], ['code', 'name'], ['wards']);
            $result = [
                'locations'=>$district->wards,
                'root' => '[Chọn phường/xã]',
            ];
        }
        
        return response()->json([
            'status' => 'Success',
            'code' => 200,
            'data' => $result,
        ]);
    }
}