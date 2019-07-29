<?php
/**
 * Created by PhpStorm.
 * User: AppleSparkle
 * Date: 7/23/2018 AD
 * Time: 5:05 PM
 */
namespace App;
use Illuminate\Database\Eloquent\Model;

Class Pony extends Model{
    protected $table = 'pony';

    protected $primaryKey = 'ponyid';

    protected $guarded = [];

    public $timestamps = false;

    public static function newPonyInTown($pony,$avatar,$ip){
        self::create([
                'ponyname' => $pony['ponyname'],
                'nickname' => $pony['ponyname'],
                'password' => md5($pony['password']),
                'created_time' => DATETIME,
                'avatar' =>$avatar,
                'ip' => $ip
            ]
        );
    }

    public static function ponyDisplay($search,$keyword,$status){
        $where = [
            ['status','>=',0]
        ];

        if($keyword){
            if($search != 'ponyid'){
                array_push($where,[$search,'like',"%".$keyword."%"]);
            }else{
                array_push($where,[$search,$keyword]);
            }
        }

        if($status != 'all'){
            array_push($where,['status',$status]);
        }

        $pony = self::where($where)
                    ->orderBy('ponyid','desc')
                    ->paginate(10);
        return $pony;
    }

    public static function ponyStatus($ponyid,$action){
        $where = [
            ['ponyid',$ponyid]
        ];
        self::where($where)->update(['status' => $action]);
    }

    public static function ponyPassUpdate($ponyid,$password){
        self::where('ponyid',$ponyid)->update([
            'password' => md5($password),
            'modified_time' => DATETIME
        ]);
    }

    public static function changelingSpotted($ponyname){
        return self::where('ponyname',$ponyname)->where('status',1)->first();
    }

    public static function loginAuth($ponyname,$password){
        $where=[
            'ponyname' => $ponyname,
            'password' => md5($password),
            'status' => 1
        ];
        return self::where($where)->first();
    }

    public static function loginInfoUpdate($ponyname,$password,$ua_info,$pony){
        $where=[
            'ponyname' => $ponyname,
            'password' => md5($password),
            'status' => 1
        ];

        Pony::where($where)->update([
            'last_login_time' => DATETIME,
            'last_login_ip' => $ua_info['ip'],
            'last_login_os' => $ua_info['os'],
            'last_login_browser' => $ua_info['browser_name'],
            'last_ip_country' => $ua_info['country'],
            'last_ip_region' => $ua_info['region'],
            'last_ip_city' => $ua_info['city'],
            'last_ip_isp' => $ua_info['isp'],
            'last_login_phone_info' => $ua_info['phone'],
            'login_num' => $pony['login_num'] + 1
        ]);
    }

    public static function ponyInfoUpdate($ponyid,$param){
        Pony::where('ponyid',$ponyid)->update([
            'nickname' => $param['nickname'],
            'intro' => $param['intro'],
            'avatar' => $param['avatar']
        ]);
    }

    public static function ponySelfInfo($ponyid){
        $pony = Pony::where('pony.ponyid',$ponyid)
            ->where('ponypost.status',1)
            ->selectRaw('hd_ponyclub_pony.*,count(hd_ponyclub_ponypost.title) as ponypost')
            ->join('ponypost','pony.ponyid','ponypost.ponyid')
            ->groupBy('pony.ponyid')
            ->first();

        if(!$pony){
            $pony = Pony::find($ponyid);
        }

        return $pony;
    }

    public static function ipRegisterCheck($ip){
        $where=[
            'ip' => $ip,
            'status' => 1
        ];

        return self::where($where)->whereRaw('date(created_time)='.DAY)->first();
    }
}