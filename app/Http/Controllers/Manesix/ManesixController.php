<?php
/**
 * Created by PhpStorm.
 * User: AppleSparkle
 * Date: 7/31/18
 * Time: 3:00 PM
 */
namespace App\Http\Controllers\Manesix;
use App\Http\Controllers\Controller;
use App\Twilight;

class ManesixController extends Controller{
    public function manesix(){
        $ponypost = Twilight::twilightSkimLetters('','','all','all','feature');
        return view('manesix.manesix.index',['ponypost' => $ponypost]);
    }
}