<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medical extends Model
{
    protected $table = "medicals";
    protected $fillable=['pdf','patient_id'];
    public $timestamps = false;

    public function doctor(){
        return $this -> hasOne('App\Models\Doctor' , 'medical_id' ) ;
    }
}
