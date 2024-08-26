<?php

namespace App\Http\Controllers\Back;

use App\Models\City;
use App\Models\Company;
use App\Models\Scope_work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Scope;

class AuthController extends Controller
{
 

    public function Register()
    {
        $city = City::get();
        $scopeWorks = Scope_work::all();
        return view('back.auth.Register',compact('city','scopeWorks'));
    }

    public function Registerform (Request $request){
        $request->validate([
            'name_company' => 'required|max:255|unique:companies,name_company',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone' => 'required|max:10|min:10|unique:companies,phone',
            'email' => 'required|max:255|email|unique:companies,email',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
            'job_title' => 'required|max:255',
            'city_id' => 'required',
            'scopeWorks_id' => 'required',
            'scopeWorks_id.*' => 'exists:scope_works,id',
        
        ]);

        try {

            $data = $request->only([
              'name_company',
              'first_name',
              'last_name',
              'phone',
              'email',
              'password',
              'job_title',
              'city_id',
              'address',
            ]);
         
            $data['password'] = Hash::make($request->password);
            $data['type'] ='admin';

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '-' . $file->getClientOriginalName();
                $destinationPath = public_path('images');
                $file->move($destinationPath, $fileName);
                $data['image'] = 'images/' . $fileName;
            }

            $Company = Company::create($data);

          
            $Company->scopeWorks()->attach($request->scopeWorks_id);
            

            toastr()->success(trans('route.Add_messages'));
           
            return redirect()->route('login');
        }
        catch (\Exception $a){
            return redirect()->back()->withErrors(['error'=>$a->getMessage()]);
      }

    }


    public function login()
    {
        return view('back.auth.login');
    }


    
    public function LoginForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        $Company = Company::where('email', $request->email)->first();
      

        if ($Company) 
        {
            if ($Company->active == 1) 
            {
                if (Auth::guard('company')->attempt($credentials)) {
                    toastr()->success(trans('route.Welcome back Mr') . $Company->first_name);

                    return redirect()->intended('dashboard');
                } else {
                    return back()->withErrors(['password' => __('route.incorrect_password')]);
                }
            }
            else {
                return back()->withErrors(['email' => __('route.account_not_active')]);
            }
        } else {
            return back()->withErrors(['email' => __('route.no_account_found')]);
        }
    }


    public function logout()
    {
        Auth::guard('company')->logout();
        return redirect('/');
    }
}
