<?php

namespace Azuriom\Plugin\Positivity\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\Positivity\Models\Bans;
use Azuriom\Plugin\Positivity\Requests\SettingRequest;

class BansController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("positivity.bans.show");
        return view('positivity::bans.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize("positivity.admin");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $this->authorize("positivity.bans.show");
        return view('positivity::bans.show', compact('uuid'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Azuriom\Plugin\Positivity\Requests\SettingRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(bansRequest $request)
    {
        $this->authorize("positivity.admin");
        $account = Bans::create($request->validated());

        return redirect()->route('positivity.bans.index')
            ->with('success', trans('positivity::messages.bans.updated'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Azuriom\Plugin\Positivity\Models\Bans $account
     */
    public function edit(Bans $account)
    {
        $this->authorize("positivity.admin");
        return view('positivity::bans.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Azuriom\Plugin\Positivity\Requests\SettingRequest $request
     * @param \Azuriom\Plugin\Positivity\Models\Bans          $account
     *
     * @return \Illuminate\Http\Response
     */
    public function update(bansRequest $request, Bans $account)
    {
        $this->authorize("positivity.admin");
        $account->update($request->validated());

        return redirect()->route('positivity.bans.index')
            ->with('success', trans('positivity::messages.bans.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Azuriom\Plugin\Positivity\Models\bans $account
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(Bans $account)
    {
        $this->authorize("positivity.admin");
        $account->destroy();

        return redirect()->route('positivity.bans.index')
            ->with('success', trans('positivity::messages.bans.removed'));
    }
}
