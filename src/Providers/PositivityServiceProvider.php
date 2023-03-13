<?php

namespace Azuriom\Plugin\Positivity\Providers;

use Azuriom\Extensions\Plugin\BasePluginServiceProvider;
use Illuminate\Support\Facades\Route;
use Azuriom\Models\Permission;

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
    }

    /**
     * Bootstrap any plugin services.
     *
     * @return void
     */
    public function boot()
    {
        $this->changeDatabase();

        $this->loadViews();

        $this->loadTranslations();

        $this->registerRouteDescriptions();

        $this->registerAdminNavigation();

        Permission::registerPermissions([
            'positivity.admin' => 'positivity::permissions.admin',
            'positivity.accounts.show' => 'positivity::permissions.accounts.show',
            'positivity.verifications.show' => 'positivity::permissions.verifications.show',
            'positivity.bans.show' => 'positivity::permissions.bans.show',
            'positivity.oldbans.show' => 'positivity::permissions.oldbans.show',
            'positivity.warns.show' => 'positivity::permissions.warns.show',
        ]);
    }

    public function changeDatabase() {
        $dbType = config("database.default");
        config([
            'database.connections.positivity.driver' => 'mysql',
            'database.connections.positivity.host' => setting('positivity.host') ?? config("database.connections." . $dbType . ".host"),
            'database.connections.positivity.port' => setting('positivity.port') ?? config("database.connections." . $dbType . ".port"),
            'database.connections.positivity.username' => setting('positivity.username') ?? config("database.connections." . $dbType . ".username"),
            'database.connections.positivity.password' => setting('positivity.password') ?? config("database.connections." . $dbType . ".password"),
            'database.connections.positivity.database' => setting('positivity.database') ?? config("database.connections." . $dbType . ".database")
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
