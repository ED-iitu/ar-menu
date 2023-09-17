<?php
namespace App\Http\Controllers\Api\v1;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\PhoneView;

class PhoneViewController extends Controller
{
    public function index(int $itemId)
    {
        $item = Item::where('id', $itemId)->first();

        if (!$item instanceof Item) {
            return response()->json(
                [
                    'message' => 'Товар не найден',
                ],
                404
            );
        }

        $phoneView = PhoneView::where('item_id', $itemId)->first();

        if (!$phoneView instanceof PhoneView) {
            $phoneView = new PhoneView();

            $phoneView->item_id = $itemId;

            if (null !== $item->shopInfo) {
                $phoneView->phone   = $item->shopInfo->phone;
                $phoneView->shop_id = $item->shopInfo->id;
            }

            $phoneView->save();

            return response()->json(
                [
                    'message' => 'Успешно сохране',
                ],
                200
            );
        }

        $phoneView->increment('count');

        return response()->json(
            [
                'message' => 'Успешно обновлено',
            ],
            200
        );
    }
}
