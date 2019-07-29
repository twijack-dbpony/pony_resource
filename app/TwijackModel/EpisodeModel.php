<?php

namespace App\TwijackModel;

use App\CoreModel;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class EpisodeModel extends CoreModel
{
    protected $table = 'episode';

    protected $dates = ['deleted_at'];

    public function bullets(){
        return $this->hasMany(BulletModel::class,'eid','id');
    }

    public static function allEpisodesDisplay($active,$sort,$fan,$page = 10){
        $episode = self::where('status',1);

        if($active != 'all'){
            $episode->where('season',$active);
        }

        if($fan != 'all'){
            $writer = WriterModel::find($fan);
            $episode->where('writer','like','%'.$writer['writer'].'%');
        }

        if($sort == 'view'){
            $episode = $episode->orderBy('click','desc');
        }elseif($sort == 'rating'){
            $episode = $episode->orderBy('imdb_rating','desc');
        }elseif($sort == 'recent'){
            $sort = explode(',',Cache::get('recent'));
            $episode = $episode->whereIn('id',$sort)->arr();

            usort($episode,function ($ep_one,$ep_two) use($sort){
                $comparison = collect($sort)->flip()->all();
                return ($comparison[$ep_one['id']] > $comparison[$ep_two['id']]) ? -1 : 1;
            });
            return $episode;
        }elseif($sort == 'bullet'){
            $episode = $episode->get();

            foreach($episode as &$e){
                $e->bullet = $e->bullets->count();
            }

            $episode = $episode->toArray();
            usort($episode, function($one, $two) {
                $oc = $one['bullet'];
                $tc = $two['bullet'];

                if ($oc == $tc) {
                    return 0;
                }
                return ($oc > $tc) ? -1 : 1;
            });
            return $episode;
        }else{
            $episode = $episode->orderBy('season')->orderBy('episode');
        }

        return $episode = $episode->paginate($page);
    }

    public static function updateClicks($eid){
        self::where('id',$eid)->increment('click');
        self::recentView($eid);
    }

    public static function seasonCount(){
        $season = self::selectRaw('season,count(season) as c')
                    ->groupBy('season')->arr();

        $s['all'] = self::count();
        foreach($season as $aj => $ts){
        //twilight & applejack
            $s[$ts['season']] = $ts['c'];
        }

        ksort($s);
        return $s;
    }

    private static function recentView($eid){
        $recent = Cache::get('recent');
        if($recent){
            $recentEp = explode(',',$recent);

            if(in_array($eid,$recentEp)){
                $index = array_search($eid,$recentEp);
                $recentEp = Arr::except($recentEp,$index);
            }else{
                if(count($recentEp) == 10){
                    array_shift($recentEp);
                }
            }
            array_push($recentEp,$eid);

            $recent = implode(',',$recentEp);
        }else{
            $recent = $eid;
        }

        Cache::put('recent',$recent,config('constants.cache'));
    }
}
