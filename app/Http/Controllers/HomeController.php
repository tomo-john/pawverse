<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dog;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function mypage()
    {
        $user = auth()->user();

        $dogs = Dog::where('user_id', $user->id)->get();

        return view('mypage', compact('dogs'));
    }
}
