<?php

namespace App\Http\Controllers\Back;

use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index(){
        $users = User::all();
        return view('back.users.index',compact('users'));
    }

    public function show($id){
        $user = User::findOrfail($id);
        $city = City::all();
        $selectedCityId = $user->city_id;
        return view('back.users.show',compact('user','city','selectedCityId'));
    }


    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'phone' => 'nullable|string|max:20'. $user->id,
                'password' => 'nullable|string|min:6|confirmed',
                'gender' => 'required|string',
                'nationality' => 'required|string',
                'birthday' => 'nullable|date',
                'city_id' => 'required|integer|exists:cities,id',
                'address' => 'nullable|string',
            ]);

            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->gender = $request->input('gender');
            $user->nationality = $request->input('nationality');
            $user->birthday = $request->input('birthday');
            $user->city_id = $request->input('city_id');
            $user->address = $request->input('address');

            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
            }

            $user->save();
            toastr()->warning(trans('route.Update_messages'));
            
            return redirect()->route('users');

        } catch (\Exception $a) {
            return redirect()->back()->withErrors(['error' => $a->getMessage()]);
        }
    }

    public function updateActiveStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->active = $request->input('active');
        $user->save();

        $user->tokens()->delete();
        return response()->json(['success' => 'User status updated successfully']);
    }

}
