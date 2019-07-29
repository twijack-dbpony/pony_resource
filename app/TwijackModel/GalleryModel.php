<?php

namespace App\TwijackModel;

use App\CoreModel;

class GalleryModel extends CoreModel
{
    protected $table = 'gallery';

    public function getNameAttribute($value){
        return ucwords(str_replace('_',' ',$value));
    }
}
