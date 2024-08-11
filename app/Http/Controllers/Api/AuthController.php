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
            'nationality' => 'required|string|max:255',
            'birthday' => 'required|date_format:d/m/Y',
            'city_id' => 'required|exists:cities,id',
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
            'address'
        ]);
    
        $data['birthday'] = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
        $data['password'] = Hash::make($request->password);
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $destinationPath = public_path('images');
            $file->move($destinationPath, $fileName);
            $data['image'] = 'images/' . $fileName;
        }
    
        $user = User::create($data);
        return $this->returnSuccessMessage('User created successfully');
        

        // return response()->json(['message' => trans(''), 'data' => $user, 'status' => true], 201);
    
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
            // return response()->json(['error'=>''] , 400);
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
        Auth::logout();
        return $this->returnSuccessMessage('User successfully signed out');
    
    }


    public function profile(Request $request)
    {
        $user = Auth::user()->load(['city']);
    
        $locale = app()->getLocale();
    
        $city = $locale == 'en' ? $user->city->name_en : $user->city->name_ar;
        $activeStatus = $locale == 'en' ? 'active' : 'مفعل';
    
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
            'active' => $activeStatus,
        ];

        return $this->returnData('profile', $date);
    
    }
    


    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:255|unique:users,phone,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'gender' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'birthday' => 'required|date_format:d/m/Y',
            'city_id' => 'required|exists:cities,id',
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
            'address'
        ]);

        if ($request->filled('birthday')) {
            $data['birthday'] = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }

            $file = $request->file('image');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $destinationPath = public_path('images');
            $file->move($destinationPath, $fileName);
            $data['image'] = 'images/' . $fileName;
        }

        $user->update($data);

        return $this->returnSuccessMessage('User updated successfully');
        // return response()->json(['message' => trans(''), 'data' => $user, 'status' => true], 200);
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
            // return response()->json(['message' => '', 'status' => true], 200);
        }
    
        return $this->returnError('User not found');
        // return response()->json(['message' => '', 'status' => false], 404);
    }
    
    

}
