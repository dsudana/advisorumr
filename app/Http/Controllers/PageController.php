<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function about()
    {
        $setting = \App\Models\SiteSetting::first();
        return view('pages.about', compact('setting'));
    }

    public function contact()
    {
        $setting = \App\Models\SiteSetting::first();
        return view('pages.contact', compact('setting'));
    }
}
