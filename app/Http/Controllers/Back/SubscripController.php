<?php

namespace App\Http\Controllers\Back;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscripController extends Controller
{
    public function index()
    {
        $Subscription = Subscription::get();
         return view('back.subscrip.index',compact('Subscription'));
    }
}
