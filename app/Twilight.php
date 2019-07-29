<?php
/**
 * Created by PhpStorm.
 * User: AppleSparkle
 * Date: 7/23/2018 AD
 * Time: 7:22 PM
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

Class Twilight extends Model{
    protected $table = 'ponypost';

    protected $primaryKey = 'postid';

    protected $guarded = [];

    public $timestamps = false;

    public static function twilightSendLetters($param,$content,$thumb=false){
        self::create([
            'title' => $param['title'],
            'description' => $param['desc'],
            'water_img' => @$thumb ? : $param['fail_image_url'],
            'content' => $content,
            'type' => $param['type'],
            'ponyid' => $param['ponyid'],
            'created_time' => DATETIME
        ]);
    }

    public static function twilightModifyLetters($param,$content,$thumb=false){
        $update = [
            'title' => $param['title'],
            'description' => $param['desc'],
            'content' => $content,
            'type' => $param['type'],
            'modified_time' => DATETIME,
            'status' => 3,
            'water_img' => @$thumb ? : $param['fail_image_url']
        ];

        self::where('postid',$param['postid'])->update($update);
    }

    public static function twilightSkimLetters($keyword,$search,$type,$status,$mode = 'list',$sort = false,$ponyid = false,$page = 10){
        $where = [
            ['postid','!=',0]
        ];

        if($type!='all'){
            array_push($where,['ponypost.type',$type]);
        }

        if($status != 'all'){
            array_push($where,['ponypost.status',$status]);
        }

        if($mode == 'list'){
            if($keyword){
                if($keyword == 'ponypost.postid'){
                    array_push($where,[$search,$keyword]);
                }else{
                    array_push($where,[$search,'like',"%".$keyword."%"]);
                }
            }
        }else if($mode == 'f_list'){
            if($keyword){
                array_push($where,['ponypost.title','like','%'.$keyword.'%']);
            }
        }

        $ponypost = self::select('ponypost.*','pony.nickname','pony.avatar','pony.intro')
                ->join('pony','pony.ponyid','ponypost.ponyid');

        if($mode == 'f_list'){
            if($sort !='created_time'){
                if($sort !='your'){
                    $orderby=$sort;
                }else{
                    array_push($where,['ponypost.ponyid',$ponyid]);
                    $orderby='ponypost.created_time';
                }
            }else{
                $orderby='ponypost.created_time';
            }
            $ponypost->latest($orderby);
        }else{
            $ponypost->orderBy('ponypost.postid','desc');
        }

        if($mode == 'feature'){
            $ponypost = $ponypost->where('ponypost.status',1)->limit(3)->get();
        }else{
            $ponypost = $ponypost->where($where)->paginate($page);
        }

        return $ponypost;
    }

    public static function incrementByTwilight($postid,$column){
        self::where('postid',$postid)->increment($column);
    }

    public static function favSummaryByTwilight($postid,$mode){
        $twilight = self::where('postid',$postid)->select('fav')->first();
        $mode == 'fav' ? $msg = " 人喜欢(已喜欢)" : $msg = " 人喜欢";
        $mode == 'fav' ? $mode = " unfav" : $mode = 'fav';

        $response['msg'] =  $twilight['fav']. $msg;
        $response['mode'] =  $mode;
        $response['postid'] =  $postid;

        return json_encode($response);
    }

    public static function twilightOpenLetters($postid){
        $ponypost = self::where('ponypost.postid',$postid)
            ->join('pony','pony.ponyid','ponypost.ponyid')
            ->select('ponypost.*','pony.nickname','pony.avatar','pony.intro')
            ->first();
        return $ponypost;
    }

    public static function sortByTwilight(){
       return self::where('status',1)
            ->groupBy('type')
            ->selectRaw('count(type) as count,type')
            ->get()
            ->toArray();
    }

    public static function activate($postid){
        $where = [
            ['postid',$postid]
        ];
        self::where($where)->update(['status' => 1]);
    }

    public static function lock($postid){
        $where = [
            ['postid',$postid]
        ];
        self::where($where)->update(['status' => 2]);
    }
}