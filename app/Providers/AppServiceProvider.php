<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use App\Models\Product;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    	$this->app->bind('path.public', function() {
    		return base_path('../public_html');
 		});
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(session_id()){
            $id=session_id();
        }
        else {
            session_start();
            $id = session_id();
        }
        $products = Product::get();
        View::share('products', $products);
        $contacts = DB::table('contacts')->get()->first();
        View::share('contacts', $contacts);
    }
}
