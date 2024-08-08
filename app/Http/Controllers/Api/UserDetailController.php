<?php

namespace App\Http\Controllers\Api;

use App\Models\User_Detail;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserDetailController extends Controller
{
    use GeneralTrait;
    
    public function index()
    {
       $user_detail =User_Detail::where('user_id',auth()->user()->id)->get();

       return $this -> returnData('user_detail',$user_detail);
    }

   


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
           
            'rang_salary' => 'required|string|max:255',
            'status_employee' => 'required|string|max:255',
            'years_experience' => 'required|string|max:255|',
            'educational_level' => 'required|string|max:255',
            'career_level' => 'required|string|max:255',
            'type_job' => 'required|string|max:255',
            'scope_work_id' => 'required|exists:scope_works,id',
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->getMessageBag()->all();
            return response()->json($errors, 401);
           
        }

        $existingDetail = User_Detail::where('user_id', Auth::id())->first();

            if ($existingDetail) {
                return response()->json(['message' => 'User details already exist', 'status' => false], 400);
            }

        $user_detail = new User_Detail();
        $user_detail->rang_salary = $request->rang_salary;
        $user_detail->status_employee = $request->status_employee;
        $user_detail->years_experience = $request->years_experience;
        $user_detail->educational_level = $request->educational_level;
        $user_detail->career_level = $request->career_level;
        $user_detail->type_job = $request->type_job;
        $user_detail->scope_work_id = $request->scope_work_id;
        $user_detail->user_id = Auth::id();
        $user_detail->save();

        return $this -> returnData('user_detail',$user_detail);
    }


    public function show($id)
    {
        $user_detail = User_Detail::where('user_id',auth()->user()->id)->get();
        $city->save();

        return $this -> returnData('user_detail',$user_detail);
    
    }

    public function update(Request $request,$id)
    {
        
        $validator = Validator::make($request->all(), [
            'rang_salary' => 'sometimes|required|string|max:255',
            'status_employee' => 'sometimes|required|string|max:255',
            'years_experience' => 'sometimes|required|string|max:255',
            'educational_level' => 'sometimes|required|string|max:255',
            'career_level' => 'sometimes|required|string|max:255',
            'type_job' => 'sometimes|required|string|max:255',
            'scope_work_id' => 'sometimes|required|exists:scope_works,id',
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors, 401);
        }
    
        
        $user_detail = User_Detail::where('user_id', Auth::id())->first();
    
        if (!$user_detail) {
            return response()->json(['message' => 'User details not found', 'status' => false], 404);
        }
    
        $user_detail->update($request->only([
            'rang_salary', 
            'status_employee', 
            'years_experience', 
            'educational_level', 
            'career_level', 
            'type_job', 
            'scope_work_id'
        ]));
    
        return $this->returnData('user_detail', $user_detail);
    }
    

    
    public function destroy($id)
    {
        $user_detail = User_Detail::findOrFail($id)->delete();
        return response()->json(['message' => 'User details deleted successfully', 'status' => true], 200);
    }
    
    
}
