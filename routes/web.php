<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

use App\Models\Package;

use App\Models\Article;

Route::get('/gallery', [\App\Http\Controllers\GalleryController::class, 'index'])->name('gallery.index');
Route::get('/', function () {
    $featuredPackages = Package::where('is_featured', true)
        ->where('status', 'published')
        ->take(6)
        ->get();

    $articles = Article::where('status', 'published')
        ->latest('published_at')
        ->take(3)
        ->get();

    $testimonials = \App\Models\Testimonial::where('is_active', true)
        ->orderBy('order')
        ->get();

    $activities = \App\Models\ActivityGallery::where('is_published', true)
        ->orderBy('activity_date', 'desc')
        ->take(9)
        ->get();

    $heroImages = \App\Models\HeroImage::where('is_active', true)
        ->orderBy('order')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('welcome', compact('featuredPackages', 'articles', 'testimonials', 'activities', 'heroImages'));
})->name('home');

Route::get('/packages', [App\Http\Controllers\PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{package:slug}', [App\Http\Controllers\PackageController::class, 'show'])->name('packages.show');
Route::get('/about', [App\Http\Controllers\PageController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\PageController::class, 'contact'])->name('contact');
Route::post('/booking', [App\Http\Controllers\BookingController::class, 'store'])->name('booking.store.public');
Route::get('/sitemap.xml', [SitemapController::class, 'index']);

Route::get('/dashboard', function () {
    $bookings = App\Models\Booking::with('package')
        ->where('user_id', Illuminate\Support\Facades\Auth::id())
        ->latest()
        ->get();
    return view('dashboard', compact('bookings'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Booking Routes
    Route::get('/booking/create/{package:slug}', [App\Http\Controllers\BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/store/{package:slug}', [App\Http\Controllers\BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{booking:booking_code}', [App\Http\Controllers\BookingController::class, 'show'])->name('bookings.show');

    // Payment
    Route::post('/payment/pay/{booking}', [App\Http\Controllers\PaymentController::class, 'pay'])->name('payment.pay');
});

// Articles / Blog
Route::get('/artikel', [\App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
Route::get('/artikel/{slug}', [\App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');

require __DIR__ . '/auth.php';
