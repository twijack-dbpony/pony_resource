<?php

namespace App\Http\Controllers\Twijack;

use App\TwijackModel\EpisodeModel;
use App\TwijackModel\WriterModel;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Agents\Interfaces\GamePonyInterface;

class EpisodeController extends Controller
{
    public $game_pony;
    public function __construct(GamePonyInterface $game_pony)
    {
        $this->game_pony = $game_pony;
    }

    public function allEpisodesDisplay(Request $request){
        $active = $request->input('active','all');
        $fan = $request->input('fan','all');
        $sort = $request->input('sort');

        $page=$request->input('page') ? : 1;
        $perPage = 10;

        $episode = EpisodeModel::allEpisodesDisplay($active,$sort,$fan);
        $season = EpisodeModel::seasonCount();

//        $lp = $this->latestPhoto(9);

        $writer = WriterModel::writerSidebar();
        $attachment = [
            'season' => $season,
            'active' => $active,
            'sort' =>  $sort,
//            'lp' => $lp,
            'writer' => $writer,
            'fan' => $fan
        ];
        if(is_array($episode)){
            $count=count($episode);
            $ep = array_slice($episode,($page - 1) * $perPage,$perPage);

            $ep = json_decode(json_encode($ep), false);

            $paginator = new Paginator($ep,$count,$perPage,$page,[
                'path'  => $request->url(),
                'query' => $request->query(),
            ]);

            $attachment = Arr::add($attachment, 'episode', $paginator);
            return view('twijack.episode.list', $attachment);
        }
        $attachment = Arr::add($attachment, 'episode', $episode);
        return view('twijack.episode.list', $attachment);
    }

    public function episodeSelfDisplay($eid){
        $episode = EpisodeModel::find($eid);
        $season = EpisodeModel::seasonCount();

        $pony = $this->game_pony->episode(explode(',',$episode['pony']));
        EpisodeModel::updateClicks($eid);

        $lp = $this->latestPhoto();

        return view('twijack.episode.self',[
            'episode' => $episode,
            'season' => $season,
            'lp' => $lp,
            'pony' => $pony
        ]);
    }

    private function latestPhoto($number = 9){
        $latest_photo = EpisodeModel::select('poster')->get()->toArray();
        $lp = array_rand(array_flip(Arr::flatten($latest_photo)),$number);
        return $lp;
    }

    public static function writerAggregate(){
        $writer = EpisodeModel::select('writer')->groupBy('writer')->get()->toArray();
        $writer = Arr::flatten($writer);
        foreach($writer as $aj => $ts){
            //twilight & applejack
            if(strpos($ts,',')){
                $list = explode(',',$ts);
                $writer[$aj] = $list[0];
                for($i = 1;$i < count($list);$i ++){
                    array_push($writer,$list[$i]);
                }
            }
        }
        $writer = array_keys(array_flip($writer));

        WriterModel::where('id','>',0)->delete();
        foreach($writer as $aj => $ts){
        //twilight & applejack
            $count = EpisodeModel::where('writer','like','%'.$ts.'%')->count();
            WriterModel::create(['writer' => $ts, 'episodeCount' => $count]);
        }
        dump('Pony Power!!');
    }
}
