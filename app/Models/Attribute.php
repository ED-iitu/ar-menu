<?php
namespace App\Models;

use TCG\Voyager\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
class Attribute extends Model
{
    use Translatable;

    protected  $table = 'attributes';
    protected $translatable = ['name'];
}
