<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // register widget hanya jika Filament terinstall
        if (class_exists(\Filament\Widgets::class)) {
            \Filament\Widgets::register([

            ]);
        }
    }
}
