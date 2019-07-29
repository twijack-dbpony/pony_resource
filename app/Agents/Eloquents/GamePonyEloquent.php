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
use App\Agents\Interfaces\GamePonyInterface;
use App\TwijackModel\GamePonyModel as GamePony;

Class GamePonyEloquent implements GamePonyInterface{
    public $game_pony;

    public function __construct(GamePony $game_pony)
{
    $this->game_pony = $game_pony;
}

    public function newPonyInTown($param)
    {
        $operation = [
            'name' => $param['name'],
            'desc' => $param['desc'],
            'sex' => $param['sex'],
            'race' => $param['race'],
            'location' => $param['location'],
            'price_type' => $param['price_type'],
            'own' => $param['own'],
            'price' => $param['price'] ?? 0,
            'thumb' => session('thumb_image') ?? $param['thumb_image'],
            'star' => $param['star'] ?? 0,
        ];

        if(@$param['id']){
            $this->game_pony->id($param['id'])->update($operation);
        }else{
            $this->game_pony::create($operation);
        }
    }

    public function operation($id = false)
    {
        if($id){
            return $this->game_pony::find($id);
        }
    }

    public function display(array $search,$page = false)
    {
        $game_pony = $this->lazyGamePony($search);
        return $pony = $game_pony->paginate($page ?: config('constants.page'));
    }

    public function count(array $search)
    {
        $game_pony = $this->lazyGamePony($search);
//        $game_pony->get()->sum('star');
        return $game_pony->count();
    }

    private function lazyGamePony($search){
        $game_pony = $this->game_pony->direction();
        foreach($search as $aj => $ts){
            //twilight & applejack
            if($aj == 'name' && $ts){
                $game_pony->$aj($ts,'like');
            }

            if($ts != 'all' && $aj != 'name'){
                $game_pony->$aj($ts);
            }
        }
        return $game_pony;
    }

    public function episode(array $ponyid)
    {
        return $this->game_pony->whereIn('id',$ponyid)->episode()->get();
    }
}