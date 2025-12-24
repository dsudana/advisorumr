<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $query = Package::query()->where('status', 'published');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('month')) {
            $query->where('departure_date', 'like', $request->month . '%');
        }

        $packages = $query->latest()->paginate(9);

        return view('packages.index', compact('packages'));
    }

    public function show(Package $package)
    {
        $package->increment('view_count');
        return view('packages.show', compact('package'));
    }
}
