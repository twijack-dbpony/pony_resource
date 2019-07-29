<?php

namespace App\TwijackModel;

use Illuminate\Database\Eloquent\Model;

class ComicModel extends Model
{
    protected $table = 'comic';

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public static function updateClicks($cid){
        self::where('id',$cid)->increment('click');
    }
}
