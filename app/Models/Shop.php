<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Shop extends Model
{
    use Translatable;
    protected $table = 'shops';

    protected $translatable = ['name', 'description'];

    public function items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function pickupPoints(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PickupPoint::class);
    }
}
