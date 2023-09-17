<?php
namespace App\Models;

use TCG\Voyager\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
class City extends Model
{
    use Translatable;

    protected $table = 'cities';
    protected $translatable = ['name'];

}
