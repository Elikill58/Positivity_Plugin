<?php

namespace Azuriom\Plugin\Positivity\Models;


use Azuriom\Models\Traits\HasTablePrefix;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Settings
 *
 * @property integer        $id
 * @property string         $name
 * @property array          $settings
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Azuriom\Plugin\Positivity\Models
 */
class Setting extends Model
{
    use HasTablePrefix;

    /**
     * The table prefix associated with the model.
     *
     * @var string
     */
    protected $prefix = 'positivity_';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['per_page', 'stats_host', 'stats_port', 'stats_username', 'stats_password', 'stats_database'];

    protected $casts = [
        'per_page' => 'integer'
    ];
    protected $hasBan = null;
    protected $isChanged = false;

    public function hasBans() {
        $this->changeDatabase();
        if($this->hasBan == null) {
            try {
                $this->hasBan = count(DB::connection("positivity")->select("SELECT version FROM negativity_migrations_history WHERE subsystem LIKE ? ORDER BY version DESC", ['bans/%'])) > 0;
            } catch (\Exception $e) {
                $this->hasBan = false;
            }
        }
        return $this->hasBan;
    }

    function isSet($smt) {
        return isset($smt) && $smt != null && $smt != '';
    }

    public function changeDatabase() {
        if($this->isChanged) {
            return; // already config
        }
        config([
            'database.connections.positivity.driver' => 'mysql',
            'database.connections.positivity.host' => isSet($this->stats_host) ? $this->stats_host : env('DB_HOST', '127.0.0.1'),
            'database.connections.positivity.port' => isSet($this->stats_port) ? $this->stats_port : env('DB_PORT', '3306'),
            'database.connections.positivity.username' => isSet($this->stats_username) ? $this->stats_username : env('DB_USERNAME', 'root'),
            'database.connections.positivity.password' => isSet($this->stats_password) ? $this->stats_password : env('DB_PASSWORD', ''),
            'database.connections.positivity.database' => isSet($this->stats_database) ? $this->stats_database : env('DB_DATABASE', '')
        ]);
        DB::purge();
    }

    public function getCheatName($key) {
        $cheatPerName = array("aimbot" => "AimBot",
            "airjump" => "AirJump",
            "airplace" => "AirPlace",
            "antiknockback" => "AntiKnockback",
            "antipotion" => "AntiPotion",
            "autoclick" => "AutoClick",
            "autosteal" => "AutoSteal",
            "blink" => "Blink",
            "chat" => "Chat",
            "checkmanager" => "CheckManager",
            "critical" => "Critical",
            "elytrafly" => "ElytraFly",
            "fastbow" => "FastBow",
            "fasteat" => "FastEat",
            "fastladder" => "FastLadder",
            "fastplace" => "FastPlace",
            "faststairs" => "FastStairs",
            "fly" => "Fly",
            "forcefield" => "ForceField",
            "groundspoof" => "GroundSpoof",
            "incorrectpacket" => "IncorrectPacket",
            "inventorymove" => "InventoryMove",
            "jesus" => "Jesus",
            "nofall" => "NoFall",
            "nopitchlimit" => "NoPitchLimit",
            "noslowdown" => "NoSlowDown",
            "noweb" => "NoWeb",
            "nuker" => "Nuker",
            "phase" => "Phase",
            "pingspoof" => "PingSpoof",
            "reach" => "Reach",
            "regen" => "Regen",
            "scaffold" => "Scaffold",
            "sneak" => "Sneak",
            "speed" => "Speed",
            "spider" => "Spider",
            "step" => "Step",
            "strafe" => "Strafe",
            "superknockback" => "SuperKnockback",
            "timer" => "Timer",
            "xray" => "XRay"
        );
        return isset($cheatPerName[$key]) ? $cheatPerName[$key] : $key . "?";
    }

    protected static $namePerUuid = array();
    public static function getPlayerName($uuid) {
        if ($uuid === null || $uuid === "" || strrpos($uuid, "#", -strlen($uuid)) !== false) {
            return $default_name;
        }
        if (array_key_exists($uuid, self::$namePerUuid)) return self::$namePerUuid[$uuid];

        $result = "?";

        $account = DB::connection("positivity")->select("SELECT * FROM negativity_accounts WHERE id = ?;", [$uuid]);
        if ($account && count($account) > 0) {
            $result = $account[0]->playername;
        }

        self::$namePerUuid[$uuid] = $result;
        return $result;
    }
}
