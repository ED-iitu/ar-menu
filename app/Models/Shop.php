<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Shop extends Model
{
    protected $table = 'shops';

    public function items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function pickupPoints(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PickupPoint::class);
    }
}
