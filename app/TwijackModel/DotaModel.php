<?php

namespace App\TwijackModel;

use App\CoreModel;

class DotaModel extends CoreModel
{
    protected $table = 'dota_pony';

    public function scopePony($query,$pony){
        return $query->where('pony','like','%'.$pony.'%');
    }

    public function scopeRole($query,$role){
        return $query->where('role','like','%'.$role.'%');
    }

    public function scopeAttribute($query,$attribute){
        return $query->where('attribute',$attribute);
    }
}
