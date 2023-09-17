<?php
namespace App\Http\Controllers\Api\v1;
use App\Http\Controllers\Controller;
use App\Models\Slider;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Slider::all();

        if ($banners->isEmpty()) {
            return response()->json(
                [
                    'message' => 'Баннеры не найдены',
                ],
                404
            );
        }

        return response()->json($banners, 200);
    }
}
