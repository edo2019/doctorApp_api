<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Http\Request; // Added
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Hash; //added
use Laravel\Jetstream\Jetstream;
use Laravel\Fortify\Fortify; // Added
use App\Models\User;


class JetstreamServiceProvider extends ServiceProvider
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
        Fortify::authenticateusing(function(Request $request){
         $user = User::where('email', $request->email)->first();
         if($user && Hash::check($request->password, $user->password) && $user->type == 'doctor'){
            return $user;
         }
        });
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
