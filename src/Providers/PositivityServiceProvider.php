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

        $this->loadViews();

        $this->loadTranslations();

        $this->loadMigrations();

        $this->registerRouteDescriptions();

        $this->registerAdminNavigation();

        Relation::morphMap([
            'settings' => Setting::class,
        ]);

        if (Schema::hasTable('positivity_settings')) {
            $set = Setting::first();
            if (!$set) {
                Setting::create();
            } else {
                $this->changeDatabase($set);
            }
        }

        Permission::registerPermissions([
            'positivity.admin' => 'positivity::permissions.admin',
            'positivity.accounts.show' => 'positivity::permissions.accounts.show',
            'positivity.verifications.show' => 'positivity::permissions.verifications.show',
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

    function isSet($smt) {
        return isset($smt) && $smt != null && $smt != '';
    }

    protected function changeDatabase(Setting $setting) {
        config([
            'database.connections.positivity.driver' => 'mysql',
            'database.connections.positivity.host' => isSet($setting->stats_host) ? $setting->stats_host : env('DB_HOST', '127.0.0.1'),
            'database.connections.positivity.port' => isSet($setting->stats_port) ? $setting->stats_port : env('DB_PORT', '3306'),
            'database.connections.positivity.username' => isSet($setting->stats_username) ? $setting->stats_username : env('DB_USERNAME', 'root'),
            'database.connections.positivity.password' => isSet($setting->stats_password) ? $setting->stats_password : env('DB_PASSWORD', ''),
            'database.connections.positivity.database' => isSet($setting->stats_database) ? $setting->stats_database : env('DB_DATABASE', '')
        ]);
        DB::purge();
    }
}
