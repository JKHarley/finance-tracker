<?php

namespace App\Services;

use App\DataTransferObjects\FrontendState;
use Illuminate\Support\ServiceProvider;

class InertiaServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(
            FrontendState::class,
            fn () => new FrontendState
        );
    }
}
