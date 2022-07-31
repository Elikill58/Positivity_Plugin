<?php

namespace Azuriom\Plugin\Positivity\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\Positivity\Models\Setting;

class ErrorController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function notFound()
    {
        $setting = Setting::first();
        return view('positivity::error.not-found', compact('setting'));
    }
}
