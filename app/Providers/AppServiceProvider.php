<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
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
        Gate::define('upload-materi', function (User $user) {
            $topUserIds = User::orderBy('points', 'desc')->take(5)->pluck('id');
            return $topUserIds->contains($user->id);
        });
    }
}