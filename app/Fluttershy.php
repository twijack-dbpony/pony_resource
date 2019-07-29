<?php
/**
 * Created by PhpStorm.
 * User: AppleSparkle
 * Date: 8/28/18
 * Time: 2:49 PM
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Fluttershy extends Model{
    protected $table = 'view';

    protected $guarded= [];

    public $timestamps = false;

    public static function fluttershyFlyBy($postid,$info,$session = false){
        self::create([
            'ponyid' => @$session['ponyid'] ? : 0,
            'postid' => $postid,
            'ponyname' => @$session['nickname'] ? : 'derpy hooves',
            'ip' => $info['ip'],
            'os' => $info['os'],
            'browser' => $info['browser_name'],
            'phone' => $info['phone'],
            'ip_region' => $info['region'],
            'ip_city' => $info['city'],
            'ip_isp' => $info['isp'],
            'view_time' => DATETIME,
        ]);
    }
}