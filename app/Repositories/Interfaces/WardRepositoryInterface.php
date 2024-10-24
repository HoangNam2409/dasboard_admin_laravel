<?php

namespace App\Repositories\Interfaces;

interface WardRepositoryInterface 
{
    public function all();

    public function findWardIdByDistrictId(int $district_id);
} 