<?php

namespace Azuriom\Plugin\Positivity\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\Positivity\Models\warns;
use Azuriom\Plugin\Positivity\Requests\SettingRequest;

class WarnsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("positivity.warns.show");
        return view('positivity::warns.index');
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
        $this->authorize("positivity.warns.show");
        return view('positivity::warns.show', compact('uuid'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Azuriom\Plugin\Positivity\Requests\SettingRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(warnsRequest $request)
    {
        $this->authorize("positivity.admin");
        $account = Warns::create($request->validated());

        return redirect()->route('positivity.warns.index')
            ->with('success', trans('positivity::messages.warns.updated'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Azuriom\Plugin\Positivity\Models\Warns $account
     */
    public function edit(Warns $account)
    {
        $this->authorize("positivity.admin");
        return view('positivity::warns.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Azuriom\Plugin\Positivity\Requests\SettingRequest $request
     * @param \Azuriom\Plugin\Positivity\Models\Warns          $account
     *
     * @return \Illuminate\Http\Response
     */
    public function update(warnsRequest $request, Warns $account)
    {
        $this->authorize("positivity.admin");
        $account->update($request->validated());

        return redirect()->route('positivity.warns.index')
            ->with('success', trans('positivity::messages.warns.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Azuriom\Plugin\Positivity\Models\Warns $account
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(Warns $account)
    {
        $this->authorize("positivity.admin");
        $account->destroy();

        return redirect()->route('positivity.warns.index')
            ->with('success', trans('positivity::messages.warns.removed'));
    }
}
