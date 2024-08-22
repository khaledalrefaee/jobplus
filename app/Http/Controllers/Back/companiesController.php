<?php

namespace App\Http\Controllers\Back;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class companiesController extends Controller
{
    public function index()
    {
        $companies = Company::where('id', '!=', auth()->guard('company')->user()->id)->get();
        return view('back.companies.index', compact('companies'));
    }

    public function updateActiveStatus(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        $company->active = $request->input('active');
        $company->save();

     
       
      
        return response()->json(['success' => 'company status updated successfully']);
    }
}
