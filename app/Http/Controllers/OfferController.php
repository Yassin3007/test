<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function create(){

        return view('ajaxoffers.create');

    }

    public function store(){

    }
}
