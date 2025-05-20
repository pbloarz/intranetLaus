<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Calendar;
use App\Models\Departament;
use App\Models\Holiday;
use App\Models\Role;
use App\Models\Timesheet;
use App\Policies\CalendarPolicy;
use App\Policies\DepartamentPolicy;
use App\Policies\HolidayPolicy;
use App\Policies\RolePolicy;
use App\Policies\TimesheetPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Holiday::class => HolidayPolicy::class,
        Role::class => RolePolicy::class,
        Calendar::class => CalendarPolicy::class,
        Departament::class => DepartamentPolicy::class,
        Timesheet::class => TimesheetPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
