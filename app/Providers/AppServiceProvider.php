<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\Utility;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Validator::extend('check_percentage', function ($attribute, $value, $parameters, $validator) {

            $sum = 0;
            foreach ($parameters as $key => $attributeName) {
                $attributeValue = Arr::get($validator->getData(), $attributeName);
                $sum += floatval($attributeValue);
            }
            $sum += floatval($value);

            return $sum <= 100;
        }, 'Enter valid percentage value.');

       // View::share('key', 'value');

        view()->composer('footer', function($view) {
            $settings = Utility::settings();
            $view->with('settings', $settings);
        });
    }
}
