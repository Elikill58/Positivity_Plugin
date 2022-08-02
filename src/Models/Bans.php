<?php

namespace Azuriom\Plugin\Positivity\Models;

use Azuriom\Models\Traits\HasTablePrefix;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Azuriom\Plugin\Positivity\Models\Setting;
use Carbon\Carbon;

/**
 * Class Account
 *
 * @property integer        $id
 * @property string         $name
 * @property array          $settings
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Azuriom\Plugin\Positivity\Models
 */
class Bans extends Model
{
    use HasTablePrefix;

    /**
     * The table name associated with the model.
     *
     * @var string
     */
    protected $table = 'negativity_bans_active';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'reason', 'banned_by', 'expiration_time', 'cheat_name', 'execution_time', 'ip'];

    protected $casts = [
        'id' => 'string'
    ];

    public function getPlayerName() {
        return Setting::getPlayerName($this->id);
    }

    public function getDateFromMillis() {
        if(!isset($this->expiration_time) || $this->expiration_time == null || $this->expiration_time <= 0)
            return trans("positivity::messages.never");
        return format_date(Carbon::createFromTimestamp($this->expiration_time / 1000));
    }
}
