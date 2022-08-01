<?php

use Azuriom\Plugin\Positivity\Controllers\HomeController;
use Azuriom\Plugin\Positivity\Controllers\AccountsController;
use Azuriom\Plugin\Positivity\Controllers\VerificationsController;
use Azuriom\Plugin\Positivity\Controllers\BansController;
use Azuriom\Plugin\Positivity\Controllers\OldBansController;
use Azuriom\Plugin\Positivity\Controllers\ErrorController;
use Azuriom\Plugin\Positivity\Models\Setting;
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
$setting = Setting::first();
$features = array("accounts" => AccountsController::class, "verifications" => VerificationsController::class);
if($setting->hasBans()) {
	$features += ["bans" => BansController::class];
	$features += ["oldbans" => OldBansController::class];
}
foreach ($features as $key => $value) {
	Route::get('/' . $key, [$value, 'index'])->name($key);
	Route::get('/'  . $key . '/{uuid?}', [$value, 'show'])->name($key . '.show');
	Route::resource('/' . $key, $value)->except('index');
}

Route::get('/error/not-found', [ErrorController::class, 'notFound'])->name('notFound');