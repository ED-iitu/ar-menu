<?php
namespace App\Http\Controllers\Api\v1;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return response()->json($items->translate(app()->getLocale()));
    }

    public function getById($id)
    {
        $item = Item::with(['category', 'attributes'])->find($id);

        if (!$item instanceof Item) {
            return response()->json(
                [
                    'message' => 'Товар не найден',
                    'data'    => [],
                ],
                404
            );
        }

// Применяем переводы
        $item->translate(app()->getLocale());

// Получаем данные
        $category = $item->category;

        $attributesData = [];

        foreach ($item->attributes as $attribute) {
            $attributeName = $attribute->translate(app()->getLocale())->name;

            // Получите перевод значения 'value' из таблицы переводов
            $translation = DB::table('translations')
                ->where('table_name', 'item_attributes')
                ->where('foreign_key', $attribute->pivot->attribute_id)
                ->where('locale', app()->getLocale())
                ->first();

            if ($translation) {
                $attributeValue = $translation->value;
            } else {
                $attributeValue = $attribute->pivot->value;
            }

            $attributesData[] = [
                'name'  => $attributeName,
                'value' => $attributeValue,
            ];
        }

        $data = [
            'item' => $item->translate(app()->getLocale()),
            'category' => $category->translate(app()->getLocale()),
            'attributes' => $attributesData,
        ];

        return response()->json($data);
    }

    public function getByCategoryId($catId)
    {
        $items = Item::with('category')->where('category_id', $catId)->get();

        $translatedItems = $items->map(function ($item) {
            $translatedItem = $item->translate(app()->getLocale());
            $translatedItem['category'] = $item->category->translate(app()->getLocale());
            return $translatedItem;
        });

        return response()->json($translatedItems);
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
