<?php

namespace Azuriom\Plugin\Positivity\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\Positivity\Models\Setting;
use Azuriom\Plugin\Positivity\Requests\SettingRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::first();
        return view('positivity::admin.index', compact('setting'));
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
    public function store(SettingRequest $request)
    {
        $setting = Setting::create($request->validated());

        return redirect()->route('positivity.admin.index')
            ->with('success', trans('positivity::admin.setting.updated'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Azuriom\Plugin\Positivity\Models\Setting $setting
     */
    public function edit(Setting $setting)
    {
        return view('positivity::admin.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Azuriom\Plugin\Positivity\Requests\SettingRequest $request
     * @param \Azuriom\Plugin\Positivity\Models\Setting          $setting
     *
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, Setting $setting)
    {
        $setting->update($request->validated());

        return redirect()->route('positivity.admin.index')
            ->with('success', trans('positivity::admin.setting.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Azuriom\Plugin\Positivity\Models\Setting $setting
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(Setting $setting)
    {
        //
    }

    public function checkDatabase(Request $request) {
        try {
            config([
                'database.connections.positivity-test.driver' => 'mysql',
                'database.connections.positivity-test.host' => isSet($request->stats_host) ? $request->stats_host : env('DB_HOST', '127.0.0.1'),
                'database.connections.positivity-test.port' => isSet($request->stats_port) ? $request->stats_port : env('DB_PORT', '3306'),
                'database.connections.positivity-test.username' => isSet($request->stats_username) ? $request->stats_username : env('DB_USERNAME', 'root'),
                'database.connections.positivity-test.password' => isSet($request->stats_password) ? $request->stats_password : env('DB_PASSWORD', ''),
                'database.connections.positivity-test.database' => isSet($request->stats_database) ? $request->stats_database : env('DB_DATABASE', '')
            ]);
            DB::purge();
            return json_encode(array("good" => count(DB::connection("positivity-test")->select("SELECT * FROM negativity_migrations_history")) > 0));
        } catch (\Exception $e) {
            return json_encode(array("good" => 0, "error" => $e->getMessage()));
        }
    }
}
