<?php

namespace App\TwijackModel;

use App\CoreModel;

class GamePonyModel extends CoreModel
{
    protected $table = 'game_pony';

    public function scopeName($query,$name,$operand = '='){
        if($operand == 'like'){
            return $query->where('name',$operand,'%'.$name.'%');
        }else{
            return $query->where('name',$name);
        }
    }

    public function scopeSex($query,$sex){
        return $query->where('sex',$sex);
    }

    public function scopeRace($query,$race){
        return $query->where('race',$race);
    }

    public function scopeLocation($query,$location){
        return $query->where('location',$location);
    }

    public function scopeOwn($query,$own){
        return $query->where('own',$own);
    }

    public function scopeEpisode($query){
        return $query->orderBy('weight','desc')->orderBy('name');
    }

    public function getStarAttribute($value){
        return floor($value);
    }
}
