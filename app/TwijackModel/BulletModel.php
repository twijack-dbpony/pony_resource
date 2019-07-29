<?php

namespace App\TwijackModel;

use Illuminate\Database\Eloquent\Model;

class BulletModel extends Model
{
    protected $table = 'bullets';

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public static function ShootingBullets($param,$eid){
        self::create([
            'eid' => $eid,
            'text' => $param['text'],
            'color' => $param['color'],
            'size' => $param['size'],
            'position' => $param['position'],
            'time' => $param['time']
        ]);
    }

    public static function countYourBullets($eid){
        return self::where('eid',$eid)->count();
    }
}
