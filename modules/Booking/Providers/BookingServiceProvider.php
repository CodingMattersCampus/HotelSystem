<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Providers;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\Config;

final class BookingServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot(Dispatcher $events) : void
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadNavigationLinks($events);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() : void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig() : void
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('booking.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php',
            'booking'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews() : void
    {
        $viewPath = resource_path('views/modules/booking');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/booking';
        }, Config::get('view.paths')), [$sourcePath]), 'booking');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations() : void
    {
        $langPath = resource_path('lang/modules/booking');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'booking');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'booking');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories() : void
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() : array
    {
        return [];
    }

    private function loadNavigationLinks(Dispatcher $events) : void
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            if (Auth::guard('booking')->check()) {
                $event->menu->add('DASHBOARD');
                $event->menu->add([
                    'text' => 'Bookings',
                    'url' => \route('booking.dashboard'),
                    'icon' => 'address-book-o',
                ]);
                $event->menu->add([
                    'text' => 'Remittance',
                    'url' => \route('booking.cash.transactions'),
                    'icon' => 'credit-card',
                ]);
//                $event->menu->add('CASH TRANSACTIONS');
//                $event->menu->add([
//                    'text' => 'Cash Advance',
//                   'url' => \route('booking.cash.advance'),
//                    'icon' => 'money',
//                ]);
//                $event->menu->add([
//                    'text' => 'Purchases',
//                    'url' => \route('booking.cash.purchases'),
//                    'icon' => 'shopping-cart',
//                ]);
                $event->menu->add('ACCOUNT SETTINGS');
//                $event->menu->add([
//                    'text' => 'Taxis',
//                    'url' => \route('booking.taxis.listing'),
//                    'icon' => 'taxi',
//                ]);
                $event->menu->add([
                    'text' => 'My Profile',
                    'url' => \route('booking.user.profile'),
                    'icon' => 'user',
                ]);
            }
        });
    }
}
