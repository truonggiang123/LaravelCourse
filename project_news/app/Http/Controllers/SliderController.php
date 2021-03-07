<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    // public function show($id)
    // {
    //     return view('user.profile', [
    //         'user' => User::findOrFail($id)
    //     ]);
    // }
    public function index()
    {
        return view('admin.slider.index');
    }
}