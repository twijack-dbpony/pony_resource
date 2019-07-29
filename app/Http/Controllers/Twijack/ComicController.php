<?php

namespace App\Http\Controllers\Twijack;

use App\Http\Controllers\Controller;
use App\TwijackModel\ComicModel;
use Symfony\Component\HttpFoundation\Request;

class ComicController extends Controller
{
    public function ComicTime(Request $request){
        $comic = ComicModel::paginate(8);
        return view('twijack.comic.list',['comic' => $comic]);
    }

    public function ComicSelf($cid){
        $c_info =ComicModel::find($cid);
        ComicModel::updateClicks($cid);

        return view('twijack.comic.self',['comic' => $c_info]);
    }
}
