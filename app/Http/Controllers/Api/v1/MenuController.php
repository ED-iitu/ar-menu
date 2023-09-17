<?php
namespace App\Http\Controllers\Api\v1;
use App\Models\Category;

class MenuController
{
    public function getMenu()
    {
        $categories = Category::all();;

        $data = [
            'categories' => $categories->translate(app()->getLocale()),
        ];

        return response()->json($data);
    }
}
