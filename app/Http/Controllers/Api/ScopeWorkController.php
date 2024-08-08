<?php

namespace App\Http\Controllers\Api;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Scope;
use App\Models\Scope_work;

class ScopeWorkController extends Controller
{
    use GeneralTrait;
    
    public function index()
    {
        $scope_work = Scope_work::selection()->get();
        return $this -> returnData('scope_work',$scope_work);
    }
}
