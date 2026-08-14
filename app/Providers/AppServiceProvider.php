<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::define('manage-technicians', function (User $user): bool {
            return in_array($user->role, ['admin', 'technician'], true);
        });

        Gate::define('manage-spare-parts', function (User $user): bool {
            return in_array($user->role, ['admin', 'receptionist', 'technician'], true);
        });

        Gate::define('manage-repairs', function (User $user): bool {
            return in_array($user->role, ['admin', 'technician'], true);
        });

        Gate::define('view-technician-dashboard', function (User $user): bool {
            return in_array($user->role, ['admin', 'technician'], true);
        });
    }
}