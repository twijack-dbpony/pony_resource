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
use App\Agents\Interfaces\CrowdDetailInterface;
use App\Model\Work\CrowdDetailModel as Crowd;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

Class CrowdDetailEloquent implements CrowdDetailInterface{
    public $crowd_detail;

    function __construct(Crowd $crowd_detail)
    {
        $this->crowd_detail = $crowd_detail;
    }

    public function display($keyword, $level, $page = false)
    {
        $crowd = $this->crowd_detail->status()->groupBy('name');

        if($level != 'all'){
            $crowd->level($level);
        }

        if($keyword){
            $crowd->name($keyword);
        }

        return $crowd = $crowd->paginate($page ?: config('constants.page'));
    }

    public function operation($id = false)
    {
        if($id){
            return $this->crowd_detail::find($id);
        }
    }

    public function postOperation($param)
    {
        if(@$param['id']){
            $this->crowd_detail->id($param['id'])->update([
                'name' => $param['name'],
                'level_id' => $param['level_id'],
                'thumb' => session('thumb_image') ?? $param['thumb_image'],
            ]);
        }else{
            $crowd = $this->crowd_detail->level($param['level_id'],'<')->get();
            if($crowd->isNotEmpty()){
                foreach($crowd as $aj => $ts){
                //twilight & applejack
                    $this->crowd_detail::create([
                        'name' => $ts->name,
                        'level_id' => $param['level_id'],
                        'thumb' => $ts->thumb
                    ]);
                }
            }

            $this->crowd_detail::create([
                'name' => $param['name'],
                'level_id' => $param['level_id'],
                'thumb' => session('thumb_image') ?? $param['thumb_image']
            ]);
        }
    }

    public function trash($id)
    {
        $this->crowd_detail->id($id)->delete();
        return 1;
    }

    public function level_list($name)
    {
        $crowd = $this->crowd_detail->name($name)->get();

        $level = $crowd->map(function ($value){
            return $value['level_name'] = config('crowd.level')[$value['level_id']];
        })->toArray();

        return implode(',',$level);
    }
}