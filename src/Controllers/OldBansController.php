<?php

namespace Azuriom\Plugin\Positivity\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\Positivity\Models\OldBans;
use Azuriom\Plugin\Positivity\Requests\SettingRequest;

class OldBansController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("positivity.oldbans.show");
        return view('positivity::oldbans.index');
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
        $this->authorize("positivity.oldbans.show");
        return view('positivity::oldbans.show', compact('uuid'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Azuriom\Plugin\Positivity\Requests\SettingRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(oldbansRequest $request)
    {
        $this->authorize("positivity.admin");
        $account = OldBans::create($request->validated());

        return redirect()->route('positivity.oldbans.index')
            ->with('success', trans('positivity::messages.oldbans.updated'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Azuriom\Plugin\Positivity\Models\OldBans $account
     */
    public function edit(OldBans $account)
    {
        $this->authorize("positivity.admin");
        return view('positivity::oldbans.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Azuriom\Plugin\Positivity\Requests\SettingRequest $request
     * @param \Azuriom\Plugin\Positivity\Models\OldBans          $account
     *
     * @return \Illuminate\Http\Response
     */
    public function update(oldbansRequest $request, OldBans $account)
    {
        $this->authorize("positivity.admin");
        $account->update($request->validated());

        return redirect()->route('positivity.oldbans.index')
            ->with('success', trans('positivity::messages.oldbans.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Azuriom\Plugin\Positivity\Models\OldBans $account
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(OldBans $account)
    {
        $this->authorize("positivity.admin");
        $account->destroy();

        return redirect()->route('positivity.oldbans.index')
            ->with('success', trans('positivity::messages.oldbans.removed'));
    }
}
