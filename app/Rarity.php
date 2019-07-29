<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rarity extends Model
{
    protected $table = "fav";

    protected $guarded = [];

    public $timestamps = false;

    public static function ruleOfRarity($param,$ponyid,$ponyname){
        $where=[
            ['postid',$param['postid']],
            ['ponyid',$ponyid],
            ['ponyname',$ponyname],
            ['status',1]
        ];

        $rarity = self::where($where)->first();
        return $rarity;
    }

    public static function rarityLovesThis($server,$postid,$ponyid,$ponyname){
        self::updateOrCreate([
            'ponyid' => $ponyid,
            'postid' => $postid,
        ],[
            'ponyid' => $ponyid,
            'postid' => $postid,
            'ponyname' => $ponyname,
            'fav_time' => DATETIME,
            'status' => 1,
            'ip' => $server['ip']
        ]);

        Twilight::where('postid',$postid)->increment('fav');
    }

    public static function rarityHatesThis($postid,$ponyid){
        self::where('postid',$postid)
            ->where('ponyid',$ponyid)
            ->update([
                'defav_time' => DATETIME,
                'status' => 2
        ]);

        Twilight::where('postid',$postid)->decrement('fav');
    }

    public static function rarityOnTheCase($ponyid){
        return self::where('ponyid', $ponyid)
                ->where('status',1)
                ->select('postid')
                ->get()
                ->toArray();
    }
}
