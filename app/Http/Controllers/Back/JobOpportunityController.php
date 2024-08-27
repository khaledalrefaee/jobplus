<?php

namespace App\Http\Controllers\Back;

use App\Models\City;
use App\Models\Job_Title;
use App\Models\Scope_work;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\JobOpportunity;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Scope;

class JobOpportunityController extends Controller
{
    public function index()
    {
        $job_opportunitys = JobOpportunity::all();
        return view('back.job_opportunity.index',compact('job_opportunitys'));
    }

    public function getjobtitlebyid($id)
    {
        $jobtitlebyid = Job_Title::where('scope_work_id', $id)->orderBy('id', 'DESC')->get(['id', 'name_en', 'name_ar']);
        return response()->json(['jobtitlebyid' => $jobtitlebyid]);
    }

    public function create()
    {
        $city =City::get();
        $scopeWorks = Scope_work::get();
        return view('back.job_opportunity.create',compact('scopeWorks','city'));
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'city_id' =>'required|exists:cities,id',
           
            'scope_work_id' => 'required|exists:scope_works,id',
            'job_title_id' => 'required|exists:job__titles,id',
            'gender' => 'required',
            'from_age' => 'nullable|integer|min:10|max:100',
            'to_age' => 'nullable|integer|min:10|max:100',
            'educational_level' => 'required|string|max:255',
            'career_level' => 'required|string|max:255',
            'years_experience' => 'required|string|max:255',
            'number_vacancies' => 'required|integer|min:1|max:10',
            'rang_salary' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'job_description' => 'required|string',
            'requirements' => 'required|string',
            'requirements_for_trainees' => 'nullable|string',
        ]);
        $company = Auth::user()->company;
        $validatedData['company_id']= Auth::id();
        $validatedData['status']= 'In Processing ';
        $validatedData['subscription_id']= null;
        
        $jobOpportunity = new JobOpportunity($validatedData);
        $jobOpportunity->save();

        return redirect()->route('Job.Opportunity')->with('success', __('route.job_opportunity_saved_successfully'));
    }
}
