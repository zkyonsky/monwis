<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        $trainers = new \App\Customs\Widyaiswara;
        $wis = $trainers->wi(Auth::user()->unit);
        return view('profile.index', compact('wis'));
    }
}
