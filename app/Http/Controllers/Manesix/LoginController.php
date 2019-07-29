<?php
/**
 * Created by PhpStorm.
 * User: AppleSparkle
 * Date: 7/31/18
 * Time: 4:17 PM
 */
namespace App\Http\Controllers\Manesix;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Pony;
use App\Applejack\UserAgentIp;
class LoginController extends Controller{
    public function login(){
        return view('manesix.login.login');
    }

    public function post_login(Request $request,UserAgentIp $uai){
        $ponyname = $request->input('ponyname');
        $password = $request->input('password');

        $validator = Validator::make($request->all(),[
            'ponyname' => 'required',
            'password' => 'required',
            'captcha' => 'required|captcha',
        ])->after(function ($validator) use ($ponyname,$password){
            $pony = Pony::loginAuth($ponyname,$password);
            if(!$pony){
                $validator->errors()->add('ponyname','用户名或密码错误(´･ω･`)');
            }
        });

        if($validator->fails()){
            return redirect()
                ->route('manesix_l')
                ->withErrors($validator)
                ->withInput();
        }

        $ua_info = $uai->information();
        $pony = Pony::loginAuth($ponyname,$password);;

        session([
            'ponyid' => $pony['ponyid'],
            'nickname' => $pony['nickname'],
            'ponyname' => $pony['ponyname'],
            'avatar' => $pony['avatar'],
        ]);

        Pony::loginInfoUpdate($ponyname,$password,$ua_info,$pony);

        return redirect()->route('manesix_self')->with('postscript','登录成功！');
    }

    public function log_out(){
        session()->forget(['ponyid','nickname','avatar']);
        return redirect()->route('manesix_l');
    }
}