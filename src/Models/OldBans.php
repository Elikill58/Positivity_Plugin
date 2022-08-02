<?php

namespace Azuriom\Plugin\Positivity\Models;

use Azuriom\Models\Traits\HasTablePrefix;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Azuriom\Plugin\Positivity\Utils;

/**
 * Class OldBans
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
        return Utils::getPlayerName($this->id);
    }
}
