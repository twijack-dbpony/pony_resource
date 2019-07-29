<?php

namespace App\Http\Controllers\Twijack;

use App\TwijackModel\BulletModel;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Controllers\Controller;

class BulletController extends Controller
{
    public function getBullets(Request $request){
        $eid = $request->input('eid');
        $bullet = BulletModel::where('eid',$eid)
            ->select('text','color','size','position','time')
            ->get()
            ->toArray();

        return response(json_encode($bullet),200)->header('Content-Type','application/json; charset=utf-8');
    }

    public function storeBullets(Request $request){
        $bullet = $request->input('danmu');
        $eid = $request->input('eid');

        $bullet = json_decode($bullet,true);
        BulletModel:: ShootingBullets($bullet,$eid);
    }

    public function countYourBullets(Request $request){
        $eid = $request->input('eid');
        $c = BulletModel::countYourBullets($eid);
        return $c;
    }
}
