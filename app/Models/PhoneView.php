<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PhoneView extends Model
{
    protected $fillable = [
        'item_id',
        'phone',
        'shop_id',
        'count'
    ];
}
