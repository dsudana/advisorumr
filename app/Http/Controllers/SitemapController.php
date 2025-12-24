<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $packages = \App\Models\Package::where('status', 'published')->get();

        return response()->view('sitemap', [
            'packages' => $packages,
        ])->header('Content-Type', 'text/xml');
    }
}
