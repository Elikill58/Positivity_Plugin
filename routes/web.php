<?php

use Azuriom\Plugin\Positivity\Controllers\HomeController;
use Azuriom\Plugin\Positivity\Controllers\AccountsController;
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

Route::get('/accounts', [AccountsController::class, 'index'])->name('index');
Route::resource('/accounts', AccountsController::class)->except('index');
