<?php

namespace App\Providers;

use App\Models\ProcessFlow;
use App\Models\ProcessFlowStep;
use App\Observers\ProcessFlowObserver;
use App\Observers\ProcessFlowStepObserver;
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
        ProcessFlow::observe(ProcessFlowObserver::class);
        ProcessFlowStep::observe(ProcessFlowStepObserver::class);
    }
}
