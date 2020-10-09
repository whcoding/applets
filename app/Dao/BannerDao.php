<?php


namespace App\Dao;

use App\Models\Banner;

class BannerDao
{

    public function getAllBanner()
    {
        return Banner::all();
    }

}
