<?php
namespace App\Http\Controllers\Api\v1;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController
{
    const BESTSELLERS_LIMIT = 15;

    public function getBestsellers(Request $request)
    {
        $limit = $request->get('limit') ?? self::BESTSELLERS_LIMIT;
        $items = Item::with('category')
            ->orderByDesc('is_bestseller')
            ->orderByDesc('views_count')
            ->limit($limit)
            ->get();

        return response()->json($items);
    }

    public function getById($id)
    {
        $item        = Item::with('shopInfo')
            ->with('shopInfo.pickupPoints')
            ->with('itemAttributes')
            ->with('category')
            ->find($id);

        if (!$item instanceof Item) {
            return response()->json(
                [
                    'message' => 'Товар не найден',
                    'data'    => [],
                ],
                404
            );
        }

        // Инкремент просмотра
        $item->views_count += 1;
        $item->save();

        return response()->json($item);
    }

    public function getByCategoryId($catId)
    {
        $items = Item::with('category')->where('category_id', $catId)->get();

        return response()->json($items);
    }

    public function getSimilar(int $id): \Illuminate\Http\JsonResponse
    {
        $item = Item::where('id', $id)->first();

        if (null == $item)
        {
            return response()->json([
                'status' => 404,
                'error'  => 'Товар не найден'
            ]);
        }

        $similar = Item::getSimilarProductsByCategory($item->category_id, $item->id);

        return response()->json($similar);
    }
}
