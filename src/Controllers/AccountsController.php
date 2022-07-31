<?php

namespace Azuriom\Plugin\Positivity\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\Positivity\Models\Setting;
use Azuriom\Plugin\Positivity\Models\Accounts;
use Azuriom\Plugin\Positivity\Requests\SettingRequest;

class AccountsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::first();
        return view('positivity::accounts.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Azuriom\Plugin\Positivity\Requests\SettingRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AccountsRequest $request)
    {
        $account = Accounts::create($request->validated());

        return redirect()->route('positivity.accounts.index')
            ->with('success', trans('positivity::messages.accounts.updated'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Azuriom\Plugin\Positivity\Models\Accounts $account
     */
    public function edit(Accounts $account)
    {
        return view('positivity::accounts.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Azuriom\Plugin\Positivity\Requests\SettingRequest $request
     * @param \Azuriom\Plugin\Positivity\Models\Accounts          $account
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AccountsRequest $request, Accounts $account)
    {
        $account->update($request->validated());

        return redirect()->route('positivity.accounts.index')
            ->with('success', trans('positivity::messages.accounts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Azuriom\Plugin\Positivity\Models\Accounts $account
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(Accounts $account)
    {
        $account->destroy();

        return redirect()->route('positivity.accounts.index')
            ->with('success', trans('positivity::messages.accounts.removed'));
    }
}
