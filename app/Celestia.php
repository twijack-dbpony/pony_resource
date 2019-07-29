<?php
/**
 * Created by PhpStorm.
 * User: AppleSparkle
 * Date: 8/2/18
 * Time: 9:02 AM
 */
namespace App;

use App\Applejack\UserAgentIp;
use \Illuminate\Database\Eloquent\Model;
class Celestia extends Model{

    protected $table = 'celestia_private_diary';

    protected $guarded = [];

    public $timestamps = false;

    public static function celestia_private_diary($operid,$ponyid,$ponyname,$module,$operation,$server){
        $userAgent = new UserAgentIp($server);
        $ua_info = $userAgent->information();

        self::create([
            'itemid' => $operid,
            'ponyid' => $ponyid,
            'ponyname' => $ponyname,
            'module' => $module,
            'operation' => $operation,
            'oper_time' => DATETIME,
            'ip'  => $ua_info['ip']
        ]);

    }
}