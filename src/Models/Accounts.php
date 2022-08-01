<?php

namespace Azuriom\Plugin\Positivity\Models;


use Azuriom\Models\Traits\HasTablePrefix;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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
class Accounts extends Model
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
    protected $fillable = ['id', 'playername', 'language', 'minerate_full_mined', 'minerate', 'most_clicks_per_second', 'violations_by_cheat', 'creation_time', 'reports', 'ip', 'show_alert'];

    protected $casts = [
        'id' => 'string'
    ];

    public function countAllViolation(){
        $nb = 0;
        foreach (explode(";", $this->violations_by_cheat) as $allCheat) {
            $tab = explode("=", $allCheat, 2);
            foreach ($tab as $cheat) {
                if(isset($tab[1]) && is_numeric($tab[1])) {
                    $nb = $nb + $tab[1];
                }
            }
        }
        return $nb;
    }
}
