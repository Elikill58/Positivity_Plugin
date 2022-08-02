<?php

namespace Azuriom\Plugin\Positivity\Controllers;

use Azuriom\Http\Controllers\Controller;

class ErrorController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function notFound()
    {
        return view('positivity::error.not-found');
    }
}
