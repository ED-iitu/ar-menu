<?php
namespace App\Http\Controllers\Api\v1;
use App\Models\Category;
use App\Models\Room;

class MenuController
{
    public function getMenu()
    {
        $data = array (
            'categories' => Category::all(),
            'rooms' => Room::all(),
        );

        return response()->json($data);
    }
}
