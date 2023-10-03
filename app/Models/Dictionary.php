<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    protected $fillable = ['entity','value','key','sort','meta'];

    protected $casts = ['meta' => 'array'];

    public static function invoiceStatus(){
        return self::dictionaryQuery('INVOICE','STATUS');
    }
    public static function tenantStatus(){
        return self::dictionaryQuery('TENANT','STATUS');
    }
    public static function environmentType(){
        return self::dictionaryQuery('ENVIRONMENT','TYPE');
    }

//    public function getValueAttribute($key)
//    {
//        return ucfirst($key);
//    }

    public static function dictionaryQuery($entity,$key){
        return self::where('entity',$entity)->where('key',$key);
    }
}
