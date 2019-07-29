<?php
/**
 * Created by PhpStorm.
 * User: AppleSparkle
 * Date: 7/17/2018 AD
 * Time: 3:05 PM
 */
namespace  App\Http\Controllers\Celestia;
use App\Applejack\UserAgentIp;
use App\Royalwatcher;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Controllers\Controller;

class RoyalwatcherController extends Controller{
    public function list(Request $request){
        $keyword = $request->input('keyword');
        $royalwatcher = Royalwatcher::royalwatcher_list($keyword);
        return view('celestia.royalwatcher.list',[
            'royalwatcher' => $royalwatcher,
            'keyword' => $keyword
        ]);
    }

    public function add(){
        return view('celestia.royalwatcher.add');
    }

    public function post_add(Request $request,UserAgentIp $uai){
        Validator::make($request->all(),[
            'royalwatcher' => 'required|min:2|max:12',
            'password' => 'required|min:4|max:16'
        ])->after(function ($validator) use ($request){
            $rw = Royalwatcher::duplicate_royalwatcher($request->input('royalwatcher'));
            if($rw){
                $validator->errors()->add('royalwatcher','用户名重复');
            }
        });
        Royalwatcher::assign_new_pony($request->all(),$uai->information());

        return redirect()->route('celestia_rl');
    }

    public function you_are_fired(Request $request){
        $rid = $request->input('rid');
        Royalwatcher::you_are_fired($rid);

        return 1;
    }

    public function you_are_hired(Request $request){
        $rid = $request->input('rid');
        Royalwatcher::you_are_hired($rid);

        return 1;
    }

    public function rw_pass_update(Request $request){
        $password = $request->input('password');
        $confirm = $request->input('confirm');
        $rid = $request->session()->get('rid');

        $validator = Validator::make($request->all(),[
            'password' => 'nullable|min:4|max:16',
            'confirm' => 'same:password'
        ]);

        if($validator->fails()){
            return redirect()->route('celestia_set')->withErrors($validator)->withInput();
        }

        if($password && $confirm){
            Royalwatcher::rwPasswordUpdate($request->all(),$rid);
        }

        return redirect()->route('celestia_set')->with('postscript','更新成功！');
    }
}