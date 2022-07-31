<?php

namespace Azuriom\Plugin\Positivity\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\Positivity\Models\Setting;
use Azuriom\Plugin\Positivity\Models\Verifications;
use Azuriom\Plugin\Positivity\Requests\SettingRequest;

class VerificationsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::first();
        return view('positivity::verifications.index', compact('setting'));
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
        $setting = Setting::first();
        return view('positivity::verifications.show', compact('uuid', 'setting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Azuriom\Plugin\Positivity\Requests\SettingRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(VerificationsRequest $request)
    {
        $account = Verifications::create($request->validated());

        return redirect()->route('positivity.verifications.index')
            ->with('success', trans('positivity::messages.verifications.updated'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Azuriom\Plugin\Positivity\Models\Verifications $account
     */
    public function edit(Verifications $account)
    {
        return view('positivity::verifications.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Azuriom\Plugin\Positivity\Requests\SettingRequest $request
     * @param \Azuriom\Plugin\Positivity\Models\Verifications          $account
     *
     * @return \Illuminate\Http\Response
     */
    public function update(VerificationsRequest $request, Verifications $account)
    {
        $account->update($request->validated());

        return redirect()->route('positivity.verifications.index')
            ->with('success', trans('positivity::messages.verifications.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Azuriom\Plugin\Positivity\Models\Verifications $account
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(Verifications $account)
    {
        $account->destroy();

        return redirect()->route('positivity.verifications.index')
            ->with('success', trans('positivity::messages.verifications.removed'));
    }
}
