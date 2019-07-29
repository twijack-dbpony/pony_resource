<?php
/**
 * Created by PhpStorm.
 * User: AppleSparkle
 * Date: 7/31/18
 * Time: 5:32 PM
 */
namespace App\Http\Controllers\Manesix;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use App\Pony;
use App\Applejack\UserAgentIp;
class RegisterController extends Controller{
    public function register(){
        return view('manesix.register.register');
    }

    public function post_register(Request $request,UserAgentIp $uai){
        $xss_symbol = ["<",">","'","\"","-","?",";",":","script","javascript","alert"];

        $validator = Validator::make($request->all(),[
            'ponyname' => 'required|min:2|max:16',
            'password' => 'required|min:4|max:16',
            'confirm' => 'same:password',
            'captcha' => 'required|captcha',
        ])->after(function ($validator) use($request) {
            $pony=Pony::changelingSpotted($request->input('ponyname'));
            if($pony){
                $validator->errors()->add('ponyname', '用户名称 重复');
            }
        });

        if($validator->fails()){
            return redirect()
                ->route('manesix_r')
                ->withErrors($validator)
                ->withInput();
        }
        $ua_info = $uai->information();

        $ip_did_it = Pony::ipRegisterCheck($ua_info['ip']);
        if($ip_did_it){
            die('同一ip每天只能注册一次 如有疑问请联系 qq:1162201851');
        }
        if($request->has('ponyname')){
            $pony = $request->all();

            $avatar=str_replace($xss_symbol,' ',strip_tags($pony['avatar']));

            Pony::newPonyInTown($pony,$avatar,$ua_info['ip']);

            return redirect()->route('manesix_l')->with('postscript','注册成功！');
        }
    }

    public function pony_avatar_upload(Request $request){
        $pony_image=$request->input('pony_image');
        $pony_image = str_replace('data:image/png;base64,', '', $pony_image);
        $pony_image = str_replace(' ', '+', $pony_image);
        $pony_image = base64_decode($pony_image);
        $filename = 'avatar/huadong_ponyclub_'.UPLOAD_TIME.'.png';
        file_put_contents($filename, $pony_image);
        echo $filename;
    }
}