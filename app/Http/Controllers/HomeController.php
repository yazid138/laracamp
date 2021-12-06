<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard()
    {
        return Auth::user()->is_admin ?
            redirect(route('admin.dashboard')) :
            redirect(route('user.dashboard'));
    }
}
