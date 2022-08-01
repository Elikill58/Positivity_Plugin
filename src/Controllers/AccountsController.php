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
        $this->authorize("positivity.accounts.show");
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $this->authorize("positivity.accounts.show");
        $setting = Setting::first();
        return view('positivity::accounts.show', compact('uuid', 'setting'));
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
        $this->authorize("positivity.admin");
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
        $this->authorize("positivity.admin");
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
        $this->authorize("positivity.admin");
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
        $this->authorize("positivity.admin");
        $account->destroy();

        return redirect()->route('positivity.accounts.index')
            ->with('success', trans('positivity::messages.accounts.removed'));
    }
}
