<?php
namespace App\Http\Controllers\Api\v1;
use App\Http\Controllers\Controller;
use App\Models\PickupPoint;
use App\Models\Shop;
use function Psy\sh;

class ShopController extends Controller
{
    public function getOneById(int $id)
    {
        $shop = Shop::where('id', $id)->with('items')->first();

        if (!$shop instanceof Shop) {
            return response()->json(
                [
                    'message' => 'Магазин не найден',
                ],
                404
            );
        }

        return response()->json($shop, 200);
    }

    public function getPickupPoints(int $id)
    {
        $points = PickupPoint::where('shop_id', $id)->get();

        return response()->json($points, 200);
    }
}
