<?php

namespace App\Providers;

use App\Models\ContactItem;
use App\Models\Image;
use App\Models\Setting;
use App\Models\Single;
use App\Models\Social;
use App\Models\Word;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale(config('app.locale'));

        // Only share data with front views, not admin
        View::composer('front.*', function ($view) {
            $locale = app()->getLocale();
            $cacheKey = 'global_view_data_' . $locale;

            $sharedData = Cache::remember($cacheKey, 3600, function () {
                $singles = Single::all()->keyBy('type');

                // Get all words and key them by their key field for frontend translations
                $trans = Word::all()->mapWithKeys(function ($word) {
                    return [$word->key => $word->title];
                })->toArray();

                return [
                    'logo' => Image::where('key', 'logo')->first(),
                    'logo_white' => Image::where('key', 'logo_white')->first(),
                    'favicon' => Image::where('key', 'favicon')->first(),
                    'home_page' => $singles->get('home'),
                    'blog_page' => $singles->get('blogs'),
                    'service_page' => $singles->get('services'),
                    'portfolio_page' => $singles->get('portfolio'),
                    'about_page' => $singles->get('about'),
                    'contact' => $singles->get('contact'),
                    'footer_socials' => Social::active()->get(),
                    'footer_contact_items' => ContactItem::active()->get(),
                    'global_whatsapp' => Setting::get('whatsapp_number'),
                    'trans' => $trans,
                ];
            });

            $view->with($sharedData);
        });
    }
}
