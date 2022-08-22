<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Null_;

class Category extends Model
{
    use Translatable;
    //
    protected $table = 'categories';
    protected $fillable = ['category_id', 'slug', 'photo', 'is_active', 'is_translatable', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];
    public $timestamps = true;

    protected $with = ['translations'];
    protected $translatedAttributes = ['name'];
    protected $casts = ['is_active' => 'boolean'];


    //Insert Into Categories Table Function
    public static function setMany($array)
    {
        foreach ($array as $key => $value) {
            if ($key === 'is_translatable') {
                self::translate($value);
            } else {
                static::updateOrCreate(
                    ['id' => $key],
                    ['slug' => $value,]
                );
            }
        }
    }

    //Insert Into Categories_translation Table Function
    public static function translate($values)
    {
        foreach ($values as $key => $value) {
            static::updateOrCreate(['slug' => $key],
                [
                    'name' => $value,
                    'is_translatable' => 1
                ]
            );
        }
    }

    //Using This Function When Need => To Bring Categories Where category_id = NULL
    public function scopeParent($query)
    {
        return $query->whereNull('category_id');
    }


    public function parent()
    {
        return $this->belongsTo(self::class, 'category_id');
    }

    public function child()
    {
        return $this->hasMany(self::class, 'id');
    }


    #################### Relations     ####################
    public function product() {
        return $this->hasMany('App\Models\ProductCategory','category_id','product_id');
    }
    #################### Relations     ####################

    public function scopeActive($query) {
        return $query->where('is_active' , 1);
    }
}
