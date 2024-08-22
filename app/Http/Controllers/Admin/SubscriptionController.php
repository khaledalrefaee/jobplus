<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function store(Request $request)  {
        $request->validate([
            'plan_id' => 'required',
            'payment_type' => 'required',
            'name'=>'required',
        ]);

        try {

            $Subscription = new Subscription();
            $Subscription->name = $request->name;
            $Subscription->plan_id = $request->plan_id;
            $Subscription->payment_type = $request->payment_type;
            $Subscription->company_id = Auth::guard('company')->id();

            $Subscription->By = $request-> By;
            $Subscription-> id_payment  = $request-> id_payment ;
            
            $Subscription->status = 'In Processing ';
            $Subscription->save();
            toastr()->success(trans('route.Add_messages'));
           
            return redirect()->back();
            
        }
        catch (\Exception $a){
            return redirect()->back()->withErrors(['error'=>$a->getMessage()]);
      }
    }
}
