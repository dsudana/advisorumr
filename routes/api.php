<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::post('/midtrans-notification', [PaymentController::class, 'notification'])->name('api.payment.notification');
