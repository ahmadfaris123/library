<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Blade::directive('currency', function ($expression) {
            return "Rp. <?php echo number_format($expression, 0, ',', '.'); ?>";
        });

        Blade::directive('idr', function ($expression) {
            return "<?php echo number_format($expression, 0, ',', '.'); ?>";
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view)
        {
            if (Auth::check()) {
                if (Auth::user() == !null) {
                    $datauser = User::select('name', 'foto')->where('id', Auth::user()->id)->first();
                    $view->with('datauser', $datauser);

                }
            }
            
        });
    }
}
