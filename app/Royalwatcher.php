<?php
/**
 * Created by PhpStorm.
 * User: AppleSparkle
 * Date: 7/23/2018 AD
 * Time: 3:25 PM
 */
namespace App;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Database\Eloquent\Model;
class Royalwatcher extends Model{
    protected $table = 'royalwatcher';

    protected $primaryKey = 'rid';

    protected $guarded = [];

    public $timestamps = false;

    public static function royalwatcher_list($keyword){
        $where = [
            ['status','!=',0]
        ];

        if($keyword){
            array_push($where,['royalwatcher','like','%'.$keyword.'%']);
        }
        $rw = self::where($where)->paginate(10);
        return $rw;
    }

    public static function login_auth($param){
        $where=[
            'royalwatcher' => @$param['royalwatcher'],
            'password' => md5(@$param['password']),
            'status' => 1
        ];
        $royalwatcher = self::where($where)->first();
        return $royalwatcher;
    }

    public static function duplicate_royalwatcher($royalwatcher){
        $where = [
            ['royalwatcher',$royalwatcher],
            ['status',1]
        ];
        $rw = self::where($where)->first();
        return $rw;
    }

    public static function post_login_record(Request $request,$ua_info){
        $royalwatcher = self::login_auth($request->all());

        $request->session()->put('rid',$royalwatcher['rid']);
        $request->session()->put('royalwatcher',$royalwatcher['royalwatcher']);
        $request->session()->put('role',$royalwatcher['role']);

        Royalwatcher::where('rid',$royalwatcher['rid'])->update([
            'login_time' => DATETIME,
            'ip' => $ua_info['ip'],
            'os' => $ua_info['os'],
            'browser' => $ua_info['browser_name'],
            'ip_region' => $ua_info['region'],
            'ip_city' => $ua_info['city'],
            'ip_isp' => $ua_info['isp'],
            'phoneinfo' => $ua_info['phone'],
            'loginnum' => DB::raw('loginnum + 1')
        ]);
    }

    public static function assign_new_pony($royalwatcher,$server){
        self::create([
            'username' => $royalwatcher['royalwatcher'],
            'password' => md5($royalwatcher['password']),
            'ip' => $server['ip'],
            'os' => $server['os'],
            'browser' => $server['browser_name'],
            'ip_region' => $server['region'],
            'ip_city' => $server['city'],
            'ip_isp' => $server['isp'],
            'phoneinfo' => $server['phone'],
            'created_time' => DATETIME
        ]);
    }

    public static function rwPasswordUpdate($parameter,$rid){
        self::where('rid',$rid)->update([
            'password' => md5($parameter['password']),
            'modified_time' => DATETIME
        ]);
    }

    public static function you_are_fired($rid){
        $where = [
            ['rid',$rid]
        ];
        self::where($where)->update([
            'status' => 2
        ]);
    }

    public static function you_are_hired($rid){
        $where = [
            ['rid',$rid]
        ];
        self::where($where)->update([
            'status' => 1
        ]);
    }
}