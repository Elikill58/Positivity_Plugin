<?php

namespace Azuriom\Plugin\Positivity\Models;

use Azuriom\Models\Traits\HasTablePrefix;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Azuriom\Plugin\Positivity\Utils;

/**
 * Class Warns
 *
 * @package Azuriom\Plugin\Positivity\Models
 */
class Warns extends Model
{
    use HasTablePrefix;

    /**
     * The table name associated with the model.
     *
     * @var string
     */
    protected $table = 'negativity_warns';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'uuid', 'reason', 'execution_time', 'warned_by', 'sanctionner', 'ip', 'active', 'revocation_time', 'revocation_by'];

    public function getPlayerName() {
        return Utils::getPlayerName($this->uuid);
    }

    public function getWarnedName() {
        return Utils::getPlayerName($this->warned_by);
    }
}
