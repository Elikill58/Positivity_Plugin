<?php

namespace Azuriom\Plugin\Positivity\Providers;

use Azuriom\Extensions\Plugin\BasePluginServiceProvider;
use Illuminate\Support\Facades\Route;
use Azuriom\Models\Permission;
use Azuriom\Plugin\Positivity\Models\Setting;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;

class PositivityServiceProvider extends BasePluginServiceProvider
{
    /**
     * Register any plugin services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMiddlewares();

        //
    }

    /**
     * Bootstrap any plugin services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->registerPolicies();

        $this->loadViews();

        $this->loadTranslations();

        $this->loadMigrations();

        $this->registerRouteDescriptions();

        $this->registerAdminNavigation();

        Relation::morphMap([
            'settings' => Setting::class,
        ]);

        if (Schema::hasTable('positivity_settings')) {
            if (!Setting::first()) {
                Setting::create();
            }
        }

        Permission::registerPermissions([
            'positivity.admin' => 'positivity::admin.permission',
        ]);
    }

    /**
     * Returns the routes that should be able to be added to the navbar.
     *
     * @return array
     */
    protected function routeDescriptions()
    {
        return [
            'positivity.index' => trans('positivity::messages.title'),
        ];
    }

    /**
     * Return the admin navigations routes to register in the dashboard.
     *
     * @return array
     */
    protected function adminNavigation()
    {
        return [
            'positivity' => [
                'name'       => trans('positivity::admin.title'), // Traduction du nom de l'onglet
                'permission' => 'positivity.admin',
                'icon'       => 'bi bi-hammer', // Icône FontAwesome
                'route'      => 'positivity.admin.index', // Route de la page
            ],
        ];
    }
}
