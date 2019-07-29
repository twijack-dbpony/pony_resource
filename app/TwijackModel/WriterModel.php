<?php

namespace App\TwijackModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class WriterModel extends Model
{
    protected $table = 'writer';

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public static function writerSidebar(){
        $writer = self::where('id','>',0)->orderBy('writer')->get()->toArray();
        $count = EpisodeModel::count();

        $writer = Arr::prepend($writer,['id' => 'all','writer' => 'all','episodeCount' => $count]);

        return $writer;
    }
}
