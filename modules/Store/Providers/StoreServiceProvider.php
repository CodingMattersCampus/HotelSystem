<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Providers;

use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\Config;

final class StoreServiceProvider extends ServiceProvider
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
            __DIR__.'/../Config/config.php' => config_path('store.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php',
            'store'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews() : void
    {
        $viewPath = resource_path('views/modules/store');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/store';
        }, Config::get('view.paths')), [$sourcePath]), 'store');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations() : void
    {
        $langPath = resource_path('lang/modules/store');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'store');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'store');
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
            if (Auth::guard('store')->check()) {
                $event->menu->add('GENERAL REPORTS');
                $event->menu->add([
                    'text' => 'Cash Remittance',
                    'url' => \route('store.cash.remittance.report'),
                    'icon' => 'money',
                ]);
                $event->menu->add([
                    'text' => 'Bookings Report',
                    'url' => \route('store.booking.report'),
                    'icon' => 'address-book-o',
                ]);
                $event->menu->add('BOOKING SETTINGS');
                $event->menu->add([
                    'text' => 'Rooms',
                    'url' => \route('store.rooms.listing'),
                    'icon' => 'home',
                ]);
                $event->menu->add([
                    'text' => 'Penalties',
                    'url' => \route('store.penalties.listing'),
                    'icon' => 'exclamation-triangle',
                ]);
                $event->menu->add([
                    'text' => 'Taxis',
                    'url' => \route('store.taxis.listing'),
                    'icon' => 'taxi',
                ]);
                $event->menu->add('INVENTORY REPORTS');
                $event->menu->add([
                    'text' => 'Food & Products',
                    'url' => \route('store.inventory.products.listing'),
                    'icon' => 'cutlery',
                ]);
                $event->menu->add([
                    'text' => 'Linens',
                    'url' => \route('store.inventory.linens.listing'),
                    'icon' => 'bed',
                ]);
                $event->menu->add('EMPLOYEE SETTINGS');
                $event->menu->add([
                    'text' => 'Employees',
                    'url' => \route('store.employee.settings'),
                    'icon' => 'users',
                ]);
                $event->menu->add('ACCOUNT SETTINGS');
                $event->menu->add([
                    'text' => 'Profile',
                    'url' => \route('store.user.profile'),
                    'icon' => 'user',
                ]);
            }
        });
    }
}
