<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\OfferRequest;
use App\Models\Doctor;
use App\Models\Offer;
use App\Models\Video;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller ;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization ;
use App\Events\VideoViewer ;
use App\Scopes\OfferScope ;


class Firstcontroller extends Controller
{
    use OfferTrait ;
    public function __construct(){

    }
    public function show() {
        return "work" ;
    }
    public function getOffers() {
      return  Offer::get() ;
    }
    //
    public function show3() {
        return "work333333" ;
    }
    //
    public function show4() {
        return "work444444" ;
    }
    public function stre(){
        Offer::create([
            'name'=>'offer3',
            'price'=>'5000',
            'details' => 'offer details'
        ]);
    }
    public function create(){
        return view('offers.create');
    }
    public function store(OfferRequest $request){


    $file_name = $this -> saveImage($request->photo , 'images/offers');

        Offer::create([

            'photo' => $file_name ,
            'name_ar' => $request->name_ar,
            'name_en' =>   $request->name_en,
            'price' =>  $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
        ]);

        return redirect()->back()->with(['success' => 'تم اضافه العرض بنجاح ']);



    }


    public function getAllOffers(){

        $offers = Offer::select('id',
        'price',
        'name_'.LaravelLocalization::getCurrentLocale() . ' as name',
        'details_' . LaravelLocalization::getCurrentLocale() . ' as details'
    )->paginate(1);

    return view('offers.all' ,['offers' =>$offers]);
    }
    public function editOffer($offer_id){
       $offer = Offer::find($offer_id) ;
       if(!$offer)
       return redirect()-> back() ;
       $offer = Offer::select('id', 'name_ar', 'name_en', 'details_ar', 'details_en', 'price')->find($offer_id);

       return view('offers.edit', ['offer'=>$offer]);

    }
    public function updateOffer(OfferRequest $request , $offer_id){
        $offer = Offer::find($offer_id) ;
       if(!$offer)
       return redirect()-> back() ;
       $offer-> update($request->all()) ;
       return redirect()->back()->with(['successs' => 'تم التحديث  بنجاح ']);



    }

    public function delete($offer_id){
        $offer = Offer::find($offer_id);
        if(!$offer)
        return redirect() -> back() ->with(['error' => __('messages.offer not exist')]) ;

        $offer->delete();
        return redirect() ->route('offers.all' , $offer_id) ->with(['success'=> __('messages.offer deleted successfully')]);
    }
    public function getVideo(){
        $video = Video::first() ;
        event(new VideoViewer($video)) ;
        return view('video')->with('video' , $video) ;
    }
    public function inactive(){
        return $offer = Offer::withoutGlobalScope(OfferScope::class)->get();

    }
    public function access() {
      return   $doctors = Doctor::select('id' , 'name' ,'gender') -> get();

//        if (isset($doctors) &&$doctors->count()>0){
//            foreach ($doctors as $doctor){
//                $doctor ->gender = $doctor -> gender == 1 ? 'male' : 'female' ;
//
//            }
//        }
//        return $doctors ;
    }

}
