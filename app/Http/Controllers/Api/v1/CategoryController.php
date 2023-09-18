<?php
namespace App\Http\Controllers\Api\v1;
use App\Models\Category;

class CategoryController
{
    public function getWithCount()
    {
        $data = Category::all();

        return response()->json($data->translate(app()->getLocale()));
    }
}
