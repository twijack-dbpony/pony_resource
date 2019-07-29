<?php

namespace App\Model\Work;

use App\CoreModel;
use Illuminate\Database\Eloquent\SoftDeletes;
class CrowdModel extends CoreModel
{
    use SoftDeletes;
    protected $table = 'crowd';

    public function getPhoneAttribute($value){
        return str_replace('852-','',str_replace('86-','',$value));
    }

    public function scopeType($query,$type){
        return $query->where('type',$type);
    }

    public function scopeLevel($query,$level){
        return $query->where('level',$level);
    }
}
