<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\LaravelLocalization;

class AuthController extends Controller
{

    use GeneralTrait;
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
            'gender' => 'required|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'birthday' => 'nullable|date_format:d/m/Y',
            'city_id' => 'exists:cities,id',
            'address' => 'nullable|string|max:255',
            'scope_work_id' => 'required|exists:scope_works,id',
            'job_title_id' => 'required|exists:job__titles,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);
           
        }
    
        $data = $request->only([
            'first_name', 
            'last_name', 
            'phone', 
            'email', 
            'gender',
            'nationality',
            'birthday',
            'city_id',
            'address',
            'scope_work_id',
            'job_title_id',
        ]);
        if ($request->filled('birthday')) {
            $data['birthday'] = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
        }
        $data['password'] = Hash::make($request->password);
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            
            $fileName = time() . '-' . preg_replace('/\s+/', '-', $file->getClientOriginalName());
            $destinationPath = public_path('images');
            $file->move($destinationPath, $fileName);
            
            $data['image'] = 'images/' . $fileName;
        }
    
        $user = User::create($data);
    
        return $this->returnSuccessMessage('User created successfully');
            
    }
    
    

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);
        }

        $user = User::where('email', $request->email)->first();
       

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->returnError('There is an error in the email or password');
        }
        if($user ->active == 0){
            return $this->returnError('This account is not active');
        }
        $token = $user->createToken('myapptoken')->plainTextToken;

     
        // $response = [
        //     'user' => $user,
        //     'token' => $token
        // ];

        return $this->returnData('token',$token);
        
    }

    
    public function logout(Request $request)
    {
        
        auth()->user()->tokens()->delete();
        return $this->returnSuccessMessage('User successfully signed out');
    
    }


    public function profile(Request $request)
    {
        
        $user = Auth::user()->load(['city','scopework','jobtitle']);
    
        $locale = app()->getLocale();
    
        $city = $locale == 'en' ? $user->city->name_en : $user->city->name_ar;

        $scopework = $locale == 'en' ? $user->scopework->name_en : $user->scopework->name_ar;

        $jobtitle = $locale == 'en' ? $user->jobtitle->name_en : $user->jobtitle->name_ar;

        $activeStatus = $locale == 'en' &&  $user->active == 0 ? 'active' : 'مفعل';
    
        $date =[
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'phone' => $user->phone,
            'email' => $user->email,
            'gender' => $user->gender,
            'nationality' => $user->nationality,
            'birthday' => $user->birthday,
            'address' => $user->address,
            'image' => asset($user->image),
            'city' => $city,
            'scopework'=>$scopework,
            'jobtitle'=>$jobtitle,
            'active' => $activeStatus,
        ];

        return $this->returnData('profile', $date);
    
    }
    


    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'scope_work_id' => 'required|exists:scope_works,id',
            'job_title_id' => 'required|exists:job__titles,id',

            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:255|unique:users,phone,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'gender' => 'required|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'birthday' => 'nullable|date_format:d/m/Y',
            'city_id' => 'nullable|required|exists:cities,id',
            'address' => 'string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);
        }

        $data = $request->only([
            'first_name', 
            'last_name', 
            'phone', 
            'email', 
            'gender',
            'nationality',
            'birthday',
            'city_id',
            'address',
            'scope_work_id',
            'job_title_id',
        ]);

        if ($request->filled('birthday')) {
            $data['birthday'] = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->filled('scope_work_id')) {
            $data['scope_work_id'] = $request->scope_work_id;
        }

        if ($request->filled('job_title_id')) {
            $data['job_title_id'] = $request->job_title_id;
        }

        if ($request->hasFile('image')) {
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }

            $file = $request->file('image');
            $fileName = time() . '-' . preg_replace('/\s+/', '-', $file->getClientOriginalName()); 
            $destinationPath = public_path('images');
            $file->move($destinationPath, $fileName);
            $data['image'] = 'images/' . $fileName;
        }

        $user->update($data);

        return $this->returnSuccessMessage('User updated successfully');
    }



    public function destroy(Request $request)
    {
        $user = User::find(auth()->id());
    
        if ($user) {
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }
    
            $request->user()->currentAccessToken()->delete();
    
            $user->delete();
    
            return $this->returnSuccessMessage('User deleted successfully and logged out');
        }
    
        return $this->returnError('User not found');
    }
    
    

}
