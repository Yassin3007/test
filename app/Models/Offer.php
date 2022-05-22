<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\OfferScope ;

class Offer extends Model
{
    //
    protected $table = "offers";
    protected $fillable = ['photo','name_ar',  'name_en', 'price', 'details_ar', 'details_en', 'created_at', 'updated_at', 'status'];
    protected $hidden = ['created_at', 'updated_at'];


public function scopeInactive($q){
    return $q -> where('status' , 0) ->whereNull('details_ar');
}

protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new OfferScope);
    }


    public  function  setNameEnAttribute($val){
    $this -> attributes['name_en'] = strtoupper($val) ;
    }



}
