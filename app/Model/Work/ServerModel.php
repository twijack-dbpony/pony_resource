<?php

namespace App\Model\Work;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServerModel extends Model
{
    use SoftDeletes;
    protected $table = 'server';

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public static function display($ip,$type,$page = 10){
        $server = self::orderBy('id','desc');

        if($ip){
            $server->where('ip',$ip);
        }

        if($type){
            $server->where('type','like','%'.$type.'%');
        }
        return $server = $server->paginate($page);
    }

    public static function operation($param){
        if(!@$param['m']){
            self::create([
                'username' => $param['username'],
                'password' => $param['password'],
                'type' => $param['type'],
                'ip' => $param['ip'],
                'port' => $param['port'],
                'ps' => $param['ps']
            ]);
        }else{
            self::where('id',$param['id'])->update([
                'username' => $param['username'],
                'password' => $param['password'],
                'type' => $param['type'],
                'ip' => $param['ip'],
                'port' => $param['port'],
                'ps' => $param['ps']
            ]);
        }
    }
}
