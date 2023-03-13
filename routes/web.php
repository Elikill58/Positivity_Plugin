<?php

use Azuriom\Plugin\Positivity\Controllers\HomeController;
use Azuriom\Plugin\Positivity\Controllers\AccountsController;
use Azuriom\Plugin\Positivity\Controllers\VerificationsController;
use Azuriom\Plugin\Positivity\Controllers\BansController;
use Azuriom\Plugin\Positivity\Controllers\OldBansController;
use Azuriom\Plugin\Positivity\Controllers\WarnsController;
use Azuriom\Plugin\Positivity\Controllers\ErrorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your plugin. These
| routes are loaded by the RouteServiceProvider of your plugin within
| a group which contains the "web" middleware group and your plugin name
| as prefix. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('index');
$features = array("accounts" => AccountsController::class, "verifications" => VerificationsController::class);

$features += ["bans" => BansController::class];
$features += ["oldbans" => OldBansController::class];
$features += ["warns" => WarnsController::class];
/*
$migrationVersions = DB::connection("positivity")->select("SELECT version, subsystem FROM negativity_migrations_history GROUP BY version ORDER BY version DESC");
foreach($migrationVersions as $row) {
	if($row->subsystem == "bans/active" && $row->version > 0)
		$features += ["bans" => BansController::class];
	else if($row->subsystem == "bans/logs" && $row->version > 0)
		$features += ["oldbans" => OldBansController::class];
	else if($row->subsystem == "warns" && $row->version >= 0)
		$features += ["warns" => WarnsController::class];
}*/
foreach ($features as $key => $value) {
	Route::get('/' . $key, [$value, 'index'])->name($key);
	Route::get('/'  . $key . '/{uuid?}', [$value, 'show'])->name($key . '.show');
	Route::resource('/' . $key, $value)->except('index');
}

Route::get('/error/not-found', [ErrorController::class, 'notFound'])->name('notFound');