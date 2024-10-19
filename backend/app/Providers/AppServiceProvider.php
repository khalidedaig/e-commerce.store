<?php

namespace App\Providers;

use App\Observers\ContactObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use App\Library\OrderHandler;
use Illuminate\Support\Facades\Route;
use App\Models\Contact;
use App\Observers\OrderObserver;
use App\Models\Order;
use App\Observers\OrderItemObserver;
use App\Models\OrderItem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register the order handler
        $this->app->bind(OrderHandler::class, function ($app) {
            return new OrderHandler(request()->get('paymentMethod'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Contact::observe(ContactObserver::class);

        Order::observe(OrderObserver::class);

        OrderItem::observe(OrderItemObserver::class);


        App::bind('helper', function () {
            return new \App\Helpers\Helper;
        });

        App::bind('config-helper', function () {
            return new \App\Helpers\ConfigHelper;
        });

        App::bind('response', function () {
            return new \App\Helpers\Response;
        });

        Route::macro('apiResourceFull', function ($uri, $controller) {
            $param = Str::of($uri)->singular()->camel();
            Route::post("{$uri}/{{$param}}/restore", [$controller, 'restore'])->name("{$uri}.restore");
            Route::delete("{$uri}/{{$param}}/force-delete", [$controller, 'forceDelete'])->name("{$uri}.force-delete");
            return Route::apiResource($uri, $controller);
        });
    }
}
