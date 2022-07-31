<?php

namespace Azuriom\Plugin\Positivity\Models;

use Azuriom\Models\Traits\HasTablePrefix;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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
}
