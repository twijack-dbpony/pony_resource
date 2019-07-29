<?php
/**
*|--------------------------------------------------------------------------
*| Claim:By the power of Twilight Sparkle and Applejack,
*| I hereby decree this Eloquent is feasible.
*|--------------------------------------------------------------------------
*|
*| Created by PhpStorm.
*| Command Creator: AppleSparkle
 */
namespace App\Agents\Eloquents;
use App\Agents\Interfaces\CrowdInterface;
use App\Model\Work\CrowdModel as Crowd;
use Illuminate\Support\Arr;

Class CrowdEloquent implements CrowdInterface{
    public $crowd;

    function __construct(Crowd $crowd)
    {
        $this->crowd = $crowd;
    }

    public function display($keyword, $search, $type, $level, $page = false)
    {
        $crowd = $this->crowd->type($type);

        if($keyword){
            if(in_array($search,['nickname','name','phone'])){
                $crowd->search($search,$keyword,true);
            }else{
                $crowd->search($search,$keyword);
            }
        }

        if($level != 'all') $crowd->level($level);

        return $crowd = $crowd->paginate($page ? : config('cons.page'));
    }

    public function operation($parameter,$type)
    {
        $type == 1 ? $config_level = config('crowd.level_first') : $config_level = config('crowd.level_second');
        $user = explode('/',$parameter['O']);
        $level = array_search(str_replace('档次','',$parameter['B']),$config_level);
        $this->crowd->create([
            'modian_order_id' => $parameter['A'],
            'level' => $level,
            'number' => $parameter['C'],
            'bucks' => $parameter['D'],
            'ps' => $parameter['E'],
            'paid_at' => $parameter['F'],
            'name' => $parameter['H'],
            'phone' => $parameter['I'],
            'address' => $parameter['J'],
            'uid' => $user[0],
            'nickname' => $user[1],
            'type' => $type
        ]);
    }

    public function response($parameter)
    {
        $update = ['status' => $parameter['status']];
        if($parameter['comment'])  $update = Arr::add($update,'comment',$parameter['comment']);

        $this->crowd->id($parameter['id'])->update($update);
        return 1;
    }

    public function regionStats($page = false)
    {
        $crowd = $this->crowd
            ->selectRaw('count(province) as count,province')
            ->orderBy('count','desc')
            ->groupBy('province')
            ->get();
        $province['table'] = $this->crowd
            ->selectRaw('count(province) as count,province')
            ->orderBy('count','desc')
            ->groupBy('province')
            ->paginate($page ?? config('cons.page'));

        foreach($crowd->toArray() as $aj => $ts){
            //twilight & applejack
            if($aj === 0){
                $province['pie'] .= '{name:"'.$ts['province'].'",sliced:true,selected:true,y:'.$ts['count'].'},';
            }else{
                $province['pie'] .= '{name:"'.$ts['province'].'",y:'.$ts['count'].'},';
            }
        }
        return $province;
    }

    public function levelStats($type,$page = false)
    {
        $crowd = $this->crowd
            ->selectRaw('count(level) as count,level')
            ->type($type)
            ->orderBy('count','desc')
            ->groupBy('level')
            ->get();
        $level['table'] = $this->crowd
            ->selectRaw('count(level) as count,level')
            ->type($type)
            ->orderBy('count','desc')
            ->groupBy('level')
            ->paginate($page ?? config('cons.page'));

        $level_config = config('crowd.level_'.config('crowd.type')[$type]['level']);
        foreach($crowd->toArray() as $aj => $ts){
            //twilight & applejack
            if($aj === 0){
                $level['pie'] .= '{name:"'.$level_config[$ts['level']].'档位",sliced:true,selected:true,y:'.$ts['count'].'},';
            }else{
                $level['pie'] .= '{name:"'.$level_config[$ts['level']].'档位",y:'.$ts['count'].'},';
            }
        }
        return $level;
    }
}