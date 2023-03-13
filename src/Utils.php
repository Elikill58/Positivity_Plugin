<?php

namespace Azuriom\Plugin\Positivity;

use Illuminate\Support\Facades\DB;

class Utils {

    protected static $namePerUuid = array();
    protected static $cheatPerName = array(
        "aimbot" => "AimBot",
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

    public static function getCheatName($key) {
        return isset(self::$cheatPerName[$key]) ? self::$cheatPerName[$key] : $key . "?";
    }

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
