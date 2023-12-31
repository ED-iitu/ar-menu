<?php
namespace App\Models;

use TCG\Voyager\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
class ItemAttribute extends Model
{
    use Translatable;

    protected $table = 'item_attributes';

    protected $translatable = ['value'];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }

}
