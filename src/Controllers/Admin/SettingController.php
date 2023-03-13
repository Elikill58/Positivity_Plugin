<?php

namespace Azuriom\Plugin\Positivity\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Models\Setting;
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
        return view('positivity::admin.index');
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'per_page' => ['required', 'integer', 'min:5'],
            'host' => ['nullable', 'string'],
            'port' => ['nullable', 'integer'],
            'username' => ['nullable', 'string'],
            'password' => ['nullable', 'string'],
            'database' => ['nullable', 'string'],
        ]);
        Setting::updateSettings([
            'positivity.per_page' => $request->input('per_page'),
            'positivity.host' => $request->input('host'),
            'positivity.port' => $request->input('port'),
            'positivity.username' => $request->input('username'),
            'positivity.password' => $request->input('password'),
            'positivity.database' => $request->input('database')
        ]);

        return redirect()->route('positivity.admin.index')->with('success', trans('positivity::admin.setting.updated'));
    }

    public function isFine($var) {
        return $var != null && $var != "";
    }

    public function checkDatabase(Request $request) {
        try {
            $dbType = config("database.default");
            config([
                'database.connections.positivity-test.driver' => $dbType,
                'database.connections.positivity-test.host' => $this->isFine($request->host) ? $request->host : config("database.connections." . $dbType . ".host"),
                'database.connections.positivity-test.port' => $this->isFine($request->port) ? $request->port : config("database.connections." . $dbType . ".port"),
                'database.connections.positivity-test.username' => $this->isFine($request->username) ? $request->username : config("database.connections." . $dbType . ".username"),
                'database.connections.positivity-test.password' => $this->isFine($request->password) ? $request->password : config("database.connections." . $dbType . ".password"),
                'database.connections.positivity-test.database' => $this->isFine($request->database) ? $request->database : config("database.connections." . $dbType . ".database")
            ]);
            DB::purge();
            return json_encode(array("good" => count(DB::connection("positivity-test")->select("SELECT * FROM negativity_migrations_history")) > 0));
        } catch (\Exception $e) {
            return json_encode(array("good" => 0, "error" => $e->getMessage()));
        }
    }
}
