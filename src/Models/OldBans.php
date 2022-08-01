<?php

namespace Azuriom\Plugin\Positivity\Models;

use Azuriom\Models\Traits\HasTablePrefix;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Azuriom\Plugin\Positivity\Models\Setting;

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
class OldBans extends Model
{
    use HasTablePrefix;

    /**
     * The table name associated with the model.
     *
     * @var string
     */
    protected $table = 'negativity_bans_log';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'reason', 'banned_by', 'expiration_time', 'cheat_name', 'revoked', 'execution_time', 'revocation_time', 'ip'];

    protected $casts = [
        'id' => 'string'
    ];

    public function getPlayerName() {
        return Setting::getPlayerName($this->id);
    }
}
