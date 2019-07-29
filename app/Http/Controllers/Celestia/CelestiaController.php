<?php
/**
 * Created by PhpStorm.
 * User: AppleSparkle
 * Date: 7/23/2018 AD
 * Time: 11:45 AM
 */
namespace App\Http\Controllers\Celestia;
use App\Http\Controllers\Controller;
use App\TwijackModel\EpisodeModel;
use Illuminate\Http\Request;

Class CelestiaController extends Controller{
    public function celestia(){
        $episode = EpisodeModel::get()->toArray();
        $episode = array_random($episode,10);
        return view('celestia.celestia',['episode' => $episode]);
    }

    public function personal_setting(){
        return view('celestia.settings');
    }

    public function upload_image(Request $request){
        if(!$request->file('image')){
          echo 2;
          exit;
        }
        $path = $request->image->store('public');
        $path = explode('/',$path);
        $image_path=config('miscellanea.upload_image_domain').'/storage/'.$path[1];
        echo $image_path;
    }
}