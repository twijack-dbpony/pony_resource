<?php
/**
 * Created by PhpStorm.
 * User: AppleSparkle
 * Date: 8/4/18
 * Time: 11:36 AM
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Pinkie extends Model{
    protected $primaryKey = 'commentid';

    protected $table = 'comment';

    protected $guarded = [];

    public $timestamps = false;

    public static function pinkieSaySomething($param,$ip){
        self::create([
            'ponyid' => $param['ponyid'],
            'postid' => $param['postid'],
            'content' => $param['content'],
            'created_time' => DATETIME,
            'ip' => $ip
        ]);
    }

    public static function pinkieCommentDisplay($postid,$page = 10){
        $pinkie = self::where('comment.status',1)
            ->where('postid',$postid)
            ->join('pony','pony.ponyid','comment.ponyid')
            ->select('comment.*','pony.nickname','pony.avatar')
            ->orderBy('created_time','desc')
            ->paginate($page);
        return $pinkie;
    }

    public static function latestPinkieTrend($page = 6){
        $pinkie = self::select('comment.*','pony.avatar','pony.nickname','ponypost.title','comment.postid')
            ->where('comment.status',1)
            ->join('ponypost','ponypost.postid','comment.postid')
            ->join('pony','pony.ponyid','comment.ponyid')
            ->orderBy('comment.created_time','desc')
            ->limit($page)
            ->get();
        return $pinkie;
    }

    public static function howManyPinkies($ponyid){
        return self::where('ponyid',$ponyid)->count();
    }

}