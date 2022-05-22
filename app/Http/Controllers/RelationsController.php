<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\Hospital;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Patient;
use App\Models\Country;
use App\User ;

class RelationsController extends Controller
{
    public function has(){

        $user = \App\User::with(['phone' => function ($q) {
            $q->select('code', 'phone', 'user_id');
        }])->find(1) ;
       // return $user -> phone ;
      //return response()->json($user) ;
     // return $user->phone->code;

      $phone = Phone::find(1) ;
      $phone -> makeVisible(['user_id']) ;
      $phone -> makeHidden(['id']);
      return $phone ->user -> name ;

    }
    public function hasPhone(){
       //return  User::whereHas('phone') ->get() ;
       return  User::whereHas('phone', function($q){
           $q ->where('code', '050' ) ;
       }) ->get() ;
    }
    public function hasNoPhone(){
        return  User::whereDoesntHave('phone') ->get() ;
     }
     public function hasMany(){
         $hospital = Hospital::with('doctors')->find(1);
         $doctors = Hospital::find(1) ->doctors ;

         $doctor = Doctor::find(2) ;
         $docs = $doctor->hospital ;



       return $docs ->name;

     }
     public function hospital(){
         $hospitals = Hospital::select('id' , 'name' , 'address') ->get() ;
         return view('doctors.hospital' )->with('hospitals' , $hospitals);
     }

     public function doctors($hospital_id){
         $hospital = Hospital::find($hospital_id) ;
         $doctors = $hospital->doctors ;
         return view('doctors.doctors')->with('doctors' , $doctors) ;

     }
     public function hasDoctor(){
         return Hospital::whereHas('doctors') ->get() ;
     }

     public function hasMaleDoctor(){

        $hos =  Hospital::with('doctors')-> whereHas('doctors' , function($q){

          $q -> where('gender'  , 2 ) ;

        }) ->get() ;

        return $hos  ;
    }
    public function deleteHospital($hospital_id){
        $hospital = Hospital::find($hospital_id) ;
        if(!$hospital ){
            return abort('404') ;
        }
        $hospital -> doctors() ->delete() ;
        $hospital -> delete();
    }
    public function many(){
        $doc = Doctor::with('services')->find(1) ;
       return $doc  ;
    }
    public function docSer(){
        $service = Service::with('doctors')->find(3) ;
        return $service ;
    }
    public function service($doctor_id){
        $doctor = Doctor::find($doctor_id) ;
        $services = $doctor -> services ;
        $doctors = Doctor::select('id' , 'name') ->get() ;
        $allServices = Service::select('id' , 'name') ->get() ;

        return view('doctors.services' , compact('services' , 'doctors' , 'allServices')) ;
    }

    public function save(Request $request){
        $doctor = Doctor::find($request -> doctor_id) ;
        if(! $doctor ){
            return abort('404') ;

        }
        $doctor ->services() -> syncWithoutDetaching($request -> servicesIds) ;
        return 'success' ;
    }
    public function through(){
        $patient = Patient::find(2) ;

        return $patient -> doctor ;
    }
    public function hasone(){
        $d = Doctor::with('medical')->find(1) ;
        return $d  ;
    }
    public function maany(){
        $country = Country::with('hospitals')->find(1) ;
        return $country ->doctors;
    }


}
