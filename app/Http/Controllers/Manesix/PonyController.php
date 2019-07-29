<?php
/**
 * Created by PhpStorm.
 * User: AppleSparkle
 * Date: 8/28/18
 * Time: 2:13 PM
 */
namespace App\Http\Controllers\Manesix;

use App\Http\Controllers\Controller;
use App\Pinkie;
use App\Pony;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PonyController extends Controller{
    public function info(Request $request){
        $ponyid = $request->session()->get('ponyid');

        $pony = Pony::ponySelfInfo($ponyid);
        $comment = Pinkie::howManyPinkies($ponyid);
        return view('manesix.pony.info',[
            'pony' => $pony,
            'comment' => $comment
        ]);
    }

    public function edit(Request $request){
        $ponyid = $request->session()->get('ponyid');
        $pony = Pony::find($ponyid);

        return view('manesix.pony.edit',['pony' => $pony]);
    }

    public function post_edit(Request $request){
        $ponyid = $request->session()->get('ponyid');

        $validator = Validator::make($request->all(),[
            'avatar' => 'required',
            'nickname' => 'required|min:2|max:20',
            'intro' => 'required',
        ]);

        if($validator->fails()){
            return redirect()
                ->route('manesix_pie')
                ->withErrors($validator)
                ->withInput();
        }

        Pony::ponyInfoUpdate($ponyid,$request->all());

        session()->put('nickname',$request->input('nickname'));
        session()->put('avatar',$request->input('avatar'));
        return redirect()->route('manesix_pi')->with('postscript','个人信息编辑成功！');
    }
}