<?php

namespace App\Http\Controllers\Api;

use PDF;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CVJobWorkController extends Controller
{
    public function download(Request $request)
    {
        $user_id = Auth::id();
        $locale = $request->input('lang', app()->getLocale());
        app()->setLocale($locale);

        $user = User::with([
            'userdetails',
            'businessgallery',
            'skill',
            'language',
            'experience',
            'certificate',
            'scopework',
            'jobtitle'
        ])->findOrFail($user_id);

        $pdf = PDF::loadView('cv.cv', compact('user'));

        return $pdf->download('cv_' . $user->first_name . '_' . $user->last_name . '_' . $locale . '.pdf');
    }
}
