<?php

namespace App\Providers;
use Laravel\Passport\Passport;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Session;
use Stripe\Stripe;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


        // \Session::put('lang', 'en_US');
        // view()->share('lang', \Session::get('lang', 'de_DE'));


        //  if (!Session()->has('user_id')) {
        //     return redirect('login');
        // }else{
        //     echo "dsjfksdjf";
        //     exit();
        // }


        // print_r(Session::all());
        // exit();
        Stripe::setApiKey(env('STRIPE_KEY'));

        Schema::defaultStringLength(191);
        Passport::routes();

        if (!Collection::hasMacro('paginate')) {
            Collection::macro('paginate', 
                function ($perPage = 15, $page = null, $options = []) {
                $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
                return (new LengthAwarePaginator(
                    $this->forPage($page, $perPage), $this->count(), $perPage, $page, $options))
                    ->withPath('');
            });
        }


        
    }
}
