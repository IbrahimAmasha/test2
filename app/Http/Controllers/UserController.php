<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function switchLanguage($lang)
    {
        App::setLocale($lang);
        Session::put('locale', $lang);
        // Redirect back to the previous page or a specific route
        return back();
    }
}
