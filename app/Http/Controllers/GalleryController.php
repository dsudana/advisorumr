<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $activities = \App\Models\ActivityGallery::where('is_published', true)
            ->orderBy('activity_date', 'desc')
            ->paginate(12);

        return view('gallery.index', compact('activities'));
    }
}
