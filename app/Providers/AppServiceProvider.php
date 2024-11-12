<?php

namespace App\Providers;

use Filament\Support\Assets\Js;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

use Filament\Support\Facades\FilamentView;
use Illuminate\Support\Facades\Vite;

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
        FilamentView::registerRenderHook('panels::body.end', fn(): string => Blade::render("@vite('resources/js/app.js')"));
        FilamentColor::register([
            'danger' => Color::Red,
            'gray' => Color::Zinc,
            'info' => Color::Blue,
            'primary' => Color::Rose,
            'success' => Color::Green,
            'warning' => Color::Amber,
        ]);

        // Register Chart.js plugins
        FilamentAsset::register([
            Js::make('chart-js-plugins', Vite::asset('resources/js/filament-chartjs-plugin.js'))->module(),
        ]);
    }
}
