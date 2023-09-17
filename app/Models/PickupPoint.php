<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class PickupPoint extends Model
{
    protected $table = 'pickup_points';

    protected $fillable = [
        'shop_id', 'address', 'schedule', 'city_id'
    ];
}
