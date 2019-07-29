<?php
/**
 * Created by PhpStorm.
 * User: AppleSparkle
 * Date: 7/31/18
 * Time: 1:48 PM
 */
namespace App\Http\Controllers\Celestia;
use App\Applejack\UserAgentIp;
use App\Http\Controllers\Controller;
use App\Royalwatcher;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller{
    public function login(){
        return view('celestia.login.login');
    }
    public function post_login(Request $request,UserAgentIp $uai){
        $luna = $request->session()->get('LunaKnowsYourHistory');
        $validator = Validator::make($request->all(),[
            'royalwatcher' => 'required',
            'password' => 'required',
            'captcha' => 'required|captcha',
        ])->after(function ($validator) use ($request){
            $rw = Royalwatcher::login_auth($request->all());
            if(!$rw){
                $validator->errors()->add('royalwatcher','用户名或密码错误(´･ω･`)');
            }
        });

        if($validator->fails()){
            return redirect()
                ->route('celestia_l')
                ->withErrors($validator)
                ->withInput();
        }
        Royalwatcher::post_login_record($request,$uai->information());

        if($luna){
           return redirect($luna);
        }

        return redirect()->route('celestia_self')->with('postscript','登录成功');

    }

    public function log_out(Request $request){
        $request->session()->forget('rid');
        $request->session()->forget('royalwatcher');
        $request->session()->forget('role');
        $request->session()->forget('LunaKnowsYourHistory');
        return redirect()->route('celestia_l');
    }
}