<?php

namespace App\Providers;

use App\Jobs\Unit\UnitCreated;
use App\Jobs\Unit\UnitDeleted;
use App\Jobs\Unit\UnitUpdated;
// use Illuminate\Support\Facades\Event;
// use App\Service\DepartmentService;
use Illuminate\Auth\Events\Registered;
use App\Jobs\Department\DepartmentCreated;
use App\Jobs\Department\DepartmentUpdated;
use App\Jobs\Designation\DesignationDeleted;
use App\Jobs\Designation\DesignationUpdated;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        \App::bindMethod(UnitCreated::class . '@handle', fn($job) => $job->handle());
        \App::bindMethod(UnitUpdated::class . '@handle', fn($job) => $job->handle());
        \App::bindMethod(UnitDeleted::class . '@handle', fn($job) => $job->handle());
        \App::bindMethod(DepartmentCreated::class . '@handle', fn($job) => $job->handle());
        \App::bindMethod(DepartmentCreated::class . '@handle', fn($job) => $job->handle());
        \App::bindMethod(DepartmentUpdated::class . '@handle', fn($job) => $job->handle());
        \App::bindMethod(DesignationUpdated::class . '@handle', fn($job) => $job->handle());
        \App::bindMethod(DesignationDeleted::class . '@handle', fn($job) => $job->handle());
        \App::bindMethod(DesignationDeleted::class . '@handle', fn($job) => $job->handle());
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
