<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Front\FirstController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    return 'welcome';
});
Route::get('/contact', function () {

    return view('contact');
})->name("contact") ;


Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home') ->middleware('verified');
Route::get('/about', function () {
    return view('about')->with(['data' => 100 , 'name' =>'yassin']);

})->name("aboutt");

route::prefix('user') -> group(function(){
    Route::get('/{id}', function ($id) {
        return $id ;
    })->middleware('auth') ;
});
route::group(['prefix' => 'yas'],function(){
    Route::get('/sin', function () {
        return "hello " ;

    });
});
route::group(['namespace'=>'Front'],function(){
    Route::get('/show', 'Firstcontroller@show');
});
Route::resource('/news', 'Firstcontroller');
Route::get('/index', function () {
    return view('index');
});
Route::get('/blog', function () {
    return view('blog');
})->name('blog');


Route::get('/fill', 'front\FirstController@store');


route::get('create' , 'OfferController@create');

route::group(['namespace'=> 'Front' ,'prefix'=> LaravelLocalization::setLocale().'/offers', 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function(){

     route::get('create', 'FirstController@create');
     route::POST('store','FirstController@store')->name('offers.store');
     route::get('all', 'FirstController@getAllOffers') ->name('offers.all');
     route::get('edit/{offer_id}', "FirstController@editOffer") ;
     route::get('delete/{offer_id}', "FirstController@delete") ->name('offers.delete') ;
     route::post('update/{offer_id}' , 'FirstController@updateOffer')->name('offers.update');
     route::get('youtube' , 'FirstController@getVideo') ;
     route::get('inactive' , 'FirstController@inactive') ;
 });

 route::group(['middleware'=>'CheckAge'] ,function(){
    route::get('adualt' , 'Auth\CustomAuthController@adualt') ->name('adualt') ;
 });


 route::get('/has' , 'RelationsController@has');
 route::get('/hasPhone' , 'RelationsController@hasPhone');
 route::get('/hasNoPhone' , 'RelationsController@hasNoPhone');
 route::get('/hasMany' , 'RelationsController@hasMany');
 route::get('hospital' , 'RelationsController@hospital') ;
 route::get('doctors/{hospital_id}' , 'RelationsController@doctors')->name('hospital.doctors') ;
 route::get('hasDoctor' , 'RelationsController@hasDoctor') ;
 route::get('hasMaleDoctor' , 'RelationsController@hasMaleDoctor') ;
 route::get('delete/{hospital_id}' , 'RelationsController@deleteHospital') ->name('hospital.delete');
 route::get('many' ,'RelationsController@many' ) ;
 route::get('docSer' ,'RelationsController@docSer' ) ;
 route::get('service/{doctor_id}' ,'RelationsController@service' )->name('doctors.services') ;
 route::post('save' ,'RelationsController@save' )->name('save.doctors.services') ;
 route::get('through' , 'RelationsController@through') ;
 route::get('hasone' , 'RelationsController@hasone') ;
 route::get('maany' , 'RelationsController@maany') ;

 route::get('access' , 'Front\Firstcontroller@access') ;






