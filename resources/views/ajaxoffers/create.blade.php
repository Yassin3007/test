@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="alert alert-success" id="success_msg" style="display: none;">
            تم الحفظ بنجاح
        </div>

        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    {{__('messages.Add your offer')}}

                </div>
                '
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <br>
                <form method="POST" id="offerForm" action="" enctype="multipart/form-data">
                    @csrf
                    {{-- <input name="_token" value="{{csrf_token()}}"> --}}


                    <div class="form-group">
                        <label for="exampleInputEmail1">أختر صوره العرض</label>
                        <input type="file" id="file" class="form-control" name="photo">

                        <small id="photo_error" class="form-text text-danger"></small>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.Offer Name ar')}}</label>
                        <input type="text" class="form-control" name="name_ar"
                               placeholder="{{__('messages.Offer Name')}}">
                        <small id="name_ar_error" class="form-text text-danger"></small>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('messages.Offer Name en')}}</label>
                        <input type="text" class="form-control" name="name_en"
                               placeholder="{{__('messages.Offer Name')}}">
                        <small id="name_en_error" class="form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.Offer Price')}}</label>
                        <input type="text" class="form-control" name="price"
                               placeholder="{{__('messages.Offer Price')}}">
                        <small id="price_error" class="form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.Offer details ar')}}</label>
                        <input type="text" class="form-control" name="details_ar"
                               placeholder="{{__('messages.Offer details')}}">
                        <small id="details_ar_error" class="form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('messages.Offer details en')}}</label>
                        <input type="text" class="form-control" name="details_en"
                               placeholder="{{__('messages.Offer details')}}">
                        <small id="details_en_error" class="form-text text-danger"></small>
                    </div>

                    <button id="save_offer" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
                </form>


            </div>
        </div>
    </div>
@stop