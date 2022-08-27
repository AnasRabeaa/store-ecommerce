<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use Translatable;
    protected $table = 'brands';
    protected $fillable = ['is_active','photo','created_at','updated_at'];
    protected $hidden = ['created_at','updated_at'];
    public $timestamps = true;

    protected $with = ['translations'];
    protected $casts = ['is_active' => 'boolean'];
    protected $translatedAttributes = ['name'];


    public function scopeActive($query) {
        return $query->where('is_active' , 1);
    }


}
