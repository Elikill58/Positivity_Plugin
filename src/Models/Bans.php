<?php

namespace Azuriom\Plugin\Positivity\Models;

use Azuriom\Models\Traits\HasTablePrefix;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Azuriom\Plugin\Positivity\Utils;
use Carbon\Carbon;

/**
 * Class Bans
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
        return Utils::getPlayerName($this->id);
    }

    public function getDateFromMillis() {
        if(!isset($this->expiration_time) || $this->expiration_time == null || $this->expiration_time <= 0)
            return trans("positivity::messages.never");
        return format_date(Carbon::createFromTimestamp($this->expiration_time / 1000));
    }
}
