<?php

namespace Adenijiayocharles\Identibyte;

use Illuminate\Support\ServiceProvider;

class IdentibyteServiceProvider extends ServiceProvider {
    public function boot() {
        $this->publishes([
            __DIR__.'/../config/identibyte.php' => config_path('identibyte.php')
        ]);
    }

    public function register() {
        $this->app->singleton(Identibyte::class, function (){
            return new Identibyte();
        });
    }
}
