<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Providers;

use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\Config;

final class OfficeServiceProvider extends ServiceProvider
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
            __DIR__.'/../Config/config.php' => config_path('office.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php',
            'office'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews() : void
    {
        $viewPath = resource_path('views/modules/office');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/office';
        }, Config::get('view.paths')), [$sourcePath]), 'office');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations() : void
    {
        $langPath = resource_path('lang/modules/office');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'office');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'office');
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
            if (Auth::guard('office')->check()) {
                $event->menu->add('GENERAL REPORTS');
                $event->menu->add([
                    'text' => 'Sales Report',
                    'url' => \route('office.sales.report'),
                    'icon' => 'bar-chart',
                ]);
                $event->menu->add([
                    'text' => 'Booking Report',
                   'url' => \route('office.booking.report'),
                    'icon' => 'address-book-o',
                ]);
                $event->menu->add('GENERAL SETTINGS');
                $event->menu->add([
                    'text' => 'Employee',
                    'url' => \route('office.employee.settings'),
                    'icon' => 'users',
                ]);
                $event->menu->add([
                    'text' => 'Rooms',
                    'url' => \route('office.rooms.listing'),
                    'icon' => 'bed',
                ]);
                $event->menu->add([
                    'text' => 'Penalties',
                    'url' => \route('office.penalties.listing'),
                    'icon' => 'exclamation-triangle',
                ]);
                $event->menu->add([
                    'text' => 'Taxis',
                    'url' => \route('office.taxis.listing'),
                    'icon' => 'taxi',
                ]);
                $event->menu->add([
                    'text' => 'Discounts',
                    'url' => \route('office.discount.listing'),
                    'icon' => 'tag',
                ]);
                $event->menu->add('INVENTORY REPORTS');
                $event->menu->add([
                    'text' => 'Food & Products',
                    'url' => \route('office.inventory.products.listing'),
                    'icon' => 'cutlery',
                ]);
                $event->menu->add([
                    'text' => 'Linens',
                    'url' => \route('office.inventory.linens.listing'),
                    'icon' => 'bed',
                ]);
//                $event->menu->add([
//                    'text' => 'Tools & Equipments',
//                    'url' => \route('office.employee.settings'),
//                    'icon' => 'wrench',
//                ]);
                $event->menu->add('ACCOUNT SETTINGS');
//                $event->menu->add([
//                    'text' => 'Admin Accounts',
//                    'url' => \route('office.user.profile'),
//                    'icon' => 'user-secret',
//                ]);
                $event->menu->add([
                    'text' => 'Profile',
                    'url' => \route('office.user.profile'),
                    'icon' => 'user',
                ]);
            }
        });
    }
}
