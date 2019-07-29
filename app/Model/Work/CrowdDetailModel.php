<?php

namespace App\Model\Work;

use App\CoreModel;
use Illuminate\Database\Eloquent\SoftDeletes;
class CrowdDetailModel extends CoreModel
{
    use SoftDeletes;
    protected  $table = 'crowd_detail';

    public function scopeLevel($query,$level,$operand = '='){
        return $query->where('level_id',$operand,$level);
    }

    public function scopeName($query,$name,$like = false){
        if($like){
            return $query->where('name','like','%'.$name.'%');
        }else{
            return $query->where('name',$name);
        }
    }
}
