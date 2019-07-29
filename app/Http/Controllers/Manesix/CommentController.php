<?php
/**
 * Created by PhpStorm.
 * User: AppleSparkle
 * Date: 8/6/18
 * Time: 4:17 PM
 */
namespace App\Http\Controllers\Manesix;

use App\Applejack\UserAgentIp;
use App\Http\Controllers\Controller;
use App\Pinkie;
use App\Twilight;
use Symfony\Component\HttpFoundation\Request;
class CommentController extends Controller{
    public function add(Request $request,UserAgentIp $uai){
        $ponyid = $request->input('ponyid');
        $postid = $request->input('postid');

        if(!$ponyid){
            echo 2;
            exit;
        }
        $ua_info = $uai->information();

        Pinkie::pinkieSaySomething($request->all(),$ua_info['ip']);
        Twilight::incrementByTwilight($postid,'comment');
        echo 1;
    }
}