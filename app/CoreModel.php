<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoreModel extends Model
{
    protected $guarded = [];

    public function scopeStatus($query,$status = 1,$operand = '='){
        return $query->where('status',$operand,$status);
    }

    public function scopeId($query,$id){
        return $query->where('id',$id);
    }

    public function scopeArr($query){
        return $query->get()->toArray();
    }

    public function scopeDirection($query,$id = 'id',$direction = 'desc'){
        return $query->orderBy($id,$direction);
    }

    public function scopeSearch($query,$search,$keyword,$like = false){
        if($like){
            return $query->where($search,'like','%'.$keyword.'%');
        }else{
            return $query->where($search,$keyword);
        }
    }
}
