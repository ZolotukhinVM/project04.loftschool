<?php

namespace App\Http\View\Composers;

use App\Category;
use App\Order;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {

        View::composer('*', function ($view) {
            $user = \Auth::user();
            if ($user) {
                $orderCount = Order::where('email', $user->email)->count();
                $view->with('orderCount', $orderCount);
            }
            $categories = Category::all('id', 'name');
            $view->with('categories', $categories);
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}