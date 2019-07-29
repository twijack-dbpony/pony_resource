<?php
/**
 *|--------------------------------------------------------------------------
 *| Claim:By the power of Twilight Sparkle and Applejack,
 *| I hereby decree this function is feasible.
 *|--------------------------------------------------------------------------
 *|
 *| Created by PhpStorm.
 *| User: AppleSparkle
 *| Date: 12/4/18
 *| Time: 9:57 AM
 */
namespace App\TwijackModel;
use Illuminate\Database\Eloquent\Model;

class PonyModel extends Model{
    protected $connection = 'twijack_project';

    protected $table = 'pony';

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public static function allPoniesDisplay(){
        return self::paginate(32);
    }
}
