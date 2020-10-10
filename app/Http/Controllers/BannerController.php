<?php


namespace App\Http\Controllers;

use App\Dao\BannerDao;
use App\Utils\JsonBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{

    public function index()
    {
        $dao = new BannerDao;
        $data = $dao->getAllBanner();
        $result = [];
        foreach ($data as $val) {
            $result[] = [
                'id' => $val->id,
                'path' => asset($val->path)
            ];
        }
        return JsonBuilder::Success($result);
    }

    public function upload(Request $request)
    {

        $file = $request->file('file')->store('public/banner');
        $path = Storage::url($file);
        return $path;
    }

}
