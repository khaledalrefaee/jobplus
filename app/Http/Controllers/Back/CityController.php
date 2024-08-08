<?php

namespace App\Http\Controllers\Back;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\back\CityRequest;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::all();
        return view('back.cities.index',compact('cities'));
    
    }

    public function store(CityRequest $request)
    {
        if(City::where('name_ar',$request->name_ar)->orwhere('name_en',$request->name_en)->exists()){
            return redirect()->back()->withErrors(trans('route.exists'));
        }
        try {
            $city = new city();
            $city->name_ar = $request->name_ar;
            $city->name_en = $request->name_en;
            $city->save();
            toastr()->success(trans('route.Add_messages'));
           
            return redirect()->back();
        }
        catch (\Exception $a){
            return redirect()->back()->withErrors(['error'=>$a->getMessage()]);
      }
    }


    public function update(CityRequest $request)
    {
        try {
            $validated = $request->validated();
            $city =city::findOrFail($request->id);
            $city->update([
                $city->name_ar = $request->name_ar,
                $city->name_en = $request->name_en,
            ]);
           
            toastr()->warning(trans('route.Update_messages'));
            return redirect()->back();
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        $city =city::findOrFail($id)->delete();
        toastr()->error(trans('route.Delete_messages'));
        return redirect()->back();
    }

}
