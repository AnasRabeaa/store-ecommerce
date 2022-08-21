<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class Setting extends Model
{
    use Translatable;
    protected $table = 'settings';
    protected $fillable = ['key', '	is_translatable	', 'plain_value'];
    protected $hidden = ['created_at','updated_at'];

    protected $with = ['translations'];
    protected $translatedAttributes = ['value'];
    protected $casts = ['is_translatable' => 'boolean'];


    public static function setMany($settings)
    {
        foreach ($settings as $key => $value) {
            if ($key === 'translatable') {
                self::translatable($value);
            } else {
                if (is_array($value)) {
                    $value = json_encode($value);
                }
                static::updateOrCreate(['key' => $key], ['plain_value' => $value]);
            }
        }
    }


    public static function translatable($values)
    {
        foreach ($values as $key => $value) {
            static::updateOrCreate(['key' => $key], ['is_translatable' => true, 'value' => $value]);
        }
    }
}
