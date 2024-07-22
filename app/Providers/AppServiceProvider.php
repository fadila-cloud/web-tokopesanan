<?php

namespace App\Providers;

use Illuminate\Database\Schema\Builder; 
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
    /*
     * The function 'Builder::defaultStringLength(125);' sets the default string length for columns in the database table schema to 125 characters.
     * This is useful for defining the maximum size of string type columns in your database without needing to manually set it for each column.
    */
    Builder::defaultStringLength(125);  
    }
}

