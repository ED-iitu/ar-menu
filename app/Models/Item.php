<?php
namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Item extends Model
{
    use Translatable;

    protected  $table = 'items';

    protected $appends = ['object_3d_array'];
    protected $translatable = ['name', 'description'];

    protected $fillable = ['views_count'];

    public static function getSimilarProductsByCategory($categoryId, $productId, $limit = 5)
    {
        return self::where('category_id', $categoryId)
            ->where('id', '!=', $productId)
            ->take($limit)
            ->get();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function itemAttributes()
    {
        return $this->attributes();
    }

    public function getImagesAttribute($image)
    {
        $cur_route = Route::current()->getName();
        $isAdmin   = !empty($cur_route);

        if ($isAdmin) {
            return $image;
        } else {
            return json_decode($image, true);
        }
    }

//    public function getSimilarProductsAttribute()
//    {
//        return self::where('category_id', $this->category_id)
//            ->where('id', '!=', $this->id)
//            ->take(10)
//            ->get();
//    }

    public function getObject3dArrayAttribute()
    {
        $cur_route = Route::current()->getName();
        $isAdmin   = !empty($cur_route);

        if ($isAdmin) {
            return $this->attributes['object_3d'];
        } else {
            return json_decode($this->attributes['object_3d'], true);
        }
    }

    public function getObjectGltfAttribute($object_gltf)
    {
        $cur_route = Route::current()->getName();
        $isAdmin   = !empty($cur_route);

        if ($isAdmin) {
            return $object_gltf;
        } else {
            return json_decode($object_gltf);
        }
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'item_attributes')->withPivot('value');
    }

    public function shopInfo()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }

    public function getUploadSettings()
    {
        return [
            'disk' => 'public',
            'path' => 'items',
        ];
    }

    private function isAdmin($string): bool
    {
        $pattern = '/login_web/';
        preg_match($pattern, $string, $matches);

        if (empty($matches)) {
            return false;
        }

        return true;
    }
}
