<?php
namespace App\Http\Controllers\Api\v1;
use App\Models\Item;
use App\Models\Room;

class RoomController
{
    public function index()
    {
        $items = Room::all();

        return response()->json($items);
    }

    public function getById($id)
    {
        $items = Item::where('room_id', $id)->get();

        return response()->json($items);
    }
}
