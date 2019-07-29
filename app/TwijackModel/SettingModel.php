<?php

namespace App\TwijackModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class SettingModel extends Model
{
    use SoftDeletes;

    protected $table = 'setting';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function scopeAn($query,$annotation){
        return $query->where('annotation',$annotation);
    }

    public static function UpdateMoney($annotation,$entity){
        self::an($annotation)->update([
            'entity' => DB::raw('entity '.$entity)
        ]);
    }
}
