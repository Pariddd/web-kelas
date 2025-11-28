<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeGalleryController;
use App\Http\Controllers\MemberController;

Route::redirect('/', '/home');

Route::get('/home', [HomeController::class, 'index'])->name('members.home');
Route::get('/gallery', [HomeGalleryController::class, 'index'])->name('gallery.home');
Route::get('/gallery-data', [HomeGalleryController::class, 'data'])->name('gallery.data');

Route::resource('admin/gallery', GalleryController::class)->names('galleries');
Route::resource('admin/member', MemberController::class);
