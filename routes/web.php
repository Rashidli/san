<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ContactItemController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SingleController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WordController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\WhyUsController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Utility routes
Route::get('storage_link', function () {
    return \Illuminate\Support\Facades\Artisan::call('storage:link');
});

Route::get('migrate', function () {
    return \Illuminate\Support\Facades\Artisan::call('migrate');
});

Route::get('optimize', function () {
    return \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});

// Admin routes
Route::group(['prefix' => 'admin'], function () {

    Route::get('/', [PageController::class, 'login'])->name('login');
    Route::get('/register', [PageController::class, 'register'])->name('register');
    Route::post('/login_submit', [AuthController::class, 'login_submit'])->name('login_submit');
    Route::post('/register_submit', [AuthController::class, 'register_submit'])->name('register_submit');

    Route::group(['middleware' => 'auth'], function () {

        Route::get('/home', [PageController::class, 'home'])->name('home');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        // Users & Permissions
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        // Content Management
        Route::resource('blogs', BlogController::class);
        Route::resource('services', ServiceController::class);
        Route::resource('portfolios', PortfolioController::class);
        Route::resource('tags', TagController::class);
        Route::resource('sliders', SliderController::class);
        Route::resource('faqs', FaqController::class);
        Route::resource('reviews', ReviewController::class);
        Route::resource('why_us', WhyUsController::class);
        Route::resource('abouts', AboutController::class);

        // Contact & Social
        Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);
        Route::resource('contact_items', ContactItemController::class);
        Route::resource('socials', SocialController::class);

        // Settings
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
        Route::resource('singles', SingleController::class);
        Route::resource('words', WordController::class);
        Route::resource('images', ImageController::class);
    });
});

// Front routes with localization
Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

    Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
    Route::get('success', [HomeController::class, 'success'])->name('success');
    Route::post('/contact_post', [HomeController::class, 'contact_post'])->name('contact_post');
    Route::get('{slug}', [HomeController::class, 'dynamicPage'])->name('dynamic.page');
});
