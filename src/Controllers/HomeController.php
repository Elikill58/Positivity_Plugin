<?php

namespace Azuriom\Plugin\Positivity\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\Positivity\Models\Setting;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("positivity.accounts.show");
        return view('positivity::index');
    }
}
