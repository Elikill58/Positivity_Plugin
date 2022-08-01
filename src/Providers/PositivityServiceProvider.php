<?php

namespace Azuriom\Plugin\Positivity\Providers;

use Azuriom\Extensions\Plugin\BasePluginServiceProvider;
use Illuminate\Support\Facades\Route;
use Azuriom\Models\Permission;
use Azuriom\Plugin\Positivity\Models\Setting;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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

        if (Schema::hasTable('positivity_settings') && !isset($setting)) {
            $setting = Setting::first();
            if (!$setting) {
                $setting = Setting::create();
            }
            $setting->changeDatabase();
        }

        $this->loadViews();

        $this->loadTranslations();

        $this->loadMigrations();

        $this->registerRouteDescriptions();

        $this->registerAdminNavigation();

        Relation::morphMap([
            'settings' => Setting::class,
        ]);

        Permission::registerPermissions([
            'positivity.admin' => 'positivity::permissions.admin',
            'positivity.accounts.show' => 'positivity::permissions.accounts.show',
            'positivity.verifications.show' => 'positivity::permissions.verifications.show',
            'positivity.bans.show' => 'positivity::permissions.bans.show',
            'positivity.oldbans.show' => 'positivity::permissions.oldbans.show',
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
