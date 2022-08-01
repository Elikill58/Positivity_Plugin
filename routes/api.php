<?php

use Azuriom\Plugin\Positivity\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::post('/check-db', [SettingController::class, 'checkDatabase'])->name('checkDatabase');

?>