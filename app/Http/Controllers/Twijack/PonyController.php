<?php

namespace App\Http\Controllers\Twijack;

use App\TwijackModel\PonyModel;
use App\Http\Controllers\Controller;

class PonyController extends Controller
{
    public function allPoniesDisplay(){
        $pony = PonyModel::allPoniesDisplay();
        return view('twijack.pony.list', ['pony' => $pony]);
    }
}
