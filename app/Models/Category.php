<?php
namespace App\Models;
use TCG\Voyager\Traits\Translatable;

class Category extends \TCG\Voyager\Models\Category
{
    use Translatable;
    protected $table = 'categories';

    protected $translatable = ['name'];
}
