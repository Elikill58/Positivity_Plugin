<?php

namespace Azuriom\Plugin\Positivity\Models;

use Azuriom\Models\Traits\HasTablePrefix;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Verifications
 *
 * @property integer        $id
 * @property string         $name
 * @property array          $settings
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Azuriom\Plugin\Positivity\Models
 */
class Verifications extends Model
{
    use HasTablePrefix;

    /**
     * The table prefix associated with the model.
     *
     * @var string
     */
    protected $prefix = 'negativity_';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'uuid', 'startedBy', 'result', 'cheats', 'player_version', 'version', 'creation_time'];

    protected $casts = [
        'id' => 'integer',
        'uuid' => 'string'
    ];

    protected $namePerUuid = array();
    public function getPlayerName() {
        if ($this->uuid === null || $this->uuid === "" || strrpos($this->uuid, "#", -strlen($this->uuid)) !== false) {
            return $default_name;
        }
        if (array_key_exists($this->uuid, $this->namePerUuid)) return $this->namePerUuid[$uuid];

        $result = "?";

        $account = DB::connection("positivity")->select("SELECT * FROM negativity_accounts WHERE id = ?;", [$this->uuid]);
        if ($account && count($account) > 0) {
            $result = $account[0]->playername;
        }

        $this->namePerUuid[$this->uuid] = $result;
        return $result;
    }

    public function parseVersionName(){
        return str_replace("_", ".", str_replace("V", "", $this->version));
    }

    public function addColorFromResult() {
        $str = "<span>" . str_replace('\\n', '<br>', $this->result);
        $codes = array(
            "0" => "#000000",
            "1" => "#0000AA",
            "2" => "#00AA00",
            "3" => "#00AAAA",
            "4" => "#AA0000",
            "5" => "#AA00AA",
            "6" => "#FFAA00",
            "7" => "#AAAAAA",
            "8" => "#555555",
            "9" => "#5555FF",
            "a" => "#55FF55",
            "b" => "#55FFFF",
            "c" => "#FF5555",
            "d" => "#FF55FF",
            "e" => "#FFFF55",
            "f" => "#FFFFFF",
        );
        foreach ($codes as $key => $value){
            $str = str_replace('&' . $key, '</span><span style="color: ' . $value . '">', $str);
            $str = str_replace('§' . $key, '</span><span style="color: ' . $value . '">', $str);
        }
        return $str . "</span>";
    }
}
