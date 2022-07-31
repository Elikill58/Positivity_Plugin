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

    protected $namePerUuid = array();
    public function getPlayerName($uuid) {
        if ($uuid === null || $uuid === "" || strrpos($uuid, "#", -strlen($uuid)) !== false) {
            return $default_name;
        }
        if (array_key_exists($uuid, $this->namePerUuid)) return $this->namePerUuid[$uuid];

        $result = "?";

        $account = DB::connection("positivity")->select("SELECT * FROM negativity_accounts WHERE id = ?;", [$uuid]);
        if ($account && count($account) > 0) {
            $result = $account[0]->playername;
        }

        $this->namePerUuid[$uuid] = $result;
        return $result;
    }

    public function parseVersionName($version){
        return str_replace("_", ".", str_replace("V", "", $version));
    }

    public function addColorFromResult($str) {
        $str = "<span>" . $str;
        $codes = array(
            "§0" => "#000000",
            "§1" => "#0000AA",
            "§2" => "#00AA00",
            "§3" => "#00AAAA",
            "§4" => "#AA0000",
            "§5" => "#AA00AA",
            "§6" => "#FFAA00",
            "§7" => "#AAAAAA",
            "§8" => "#555555",
            "§9" => "#5555FF",
            "§a" => "#55FF55",
            "§b" => "#55FFFF",
            "§c" => "#FF5555",
            "§d" => "#FF55FF",
            "§e" => "#FFFF55",
            "§f" => "#FFFFFF",

            "&0" => "#000000",
            "&1" => "#0000AA",
            "&2" => "#00AA00",
            "&3" => "#00AAAA",
            "&4" => "#AA0000",
            "&5" => "#AA00AA",
            "&6" => "#FFAA00",
            "&7" => "#AAAAAA",
            "&8" => "#555555",
            "&9" => "#5555FF",
            "&a" => "#55FF55",
            "&b" => "#55FFFF",
            "&c" => "#FF5555",
            "&d" => "#FF55FF",
            "&e" => "#FFFF55",
            "&f" => "#FFFFFF"
        );
        foreach ($codes as $key => $value){
            $str = str_replace($key, '</span><span style="color: ' . $value . '">', $str);
        }
        return $str . "</span>";
    }
}
