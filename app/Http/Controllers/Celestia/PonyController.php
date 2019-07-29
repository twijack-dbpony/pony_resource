<?php
/**
 * Created by PhpStorm.
 * User: AppleSparkle
 * Date: 7/23/2018 AD
 * Time: 5:10 PM
 */
namespace  App\Http\Controllers\Celestia;
use App\Pony;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Controllers\Controller;

class PonyController extends Controller{
    public function list(Request $request){
        $search = $request->input('search');
        $keyword = $request->input('keyword');
        $status = $request->input('status') ? : 'all';
        $pony = Pony::ponyDisplay($search,$keyword,$status);

        return view('celestia.pony.list',[
            'pony' => $pony,
            'search' => $search,
            'keyword' => $keyword,
            'status' => $status
        ]);
    }

    public function activate(Request $request){
        $ponyid = $request->input('ponyid');
        Pony::ponyStatus($ponyid,1);

        return 1;
    }

    public function lock(Request $request){
        $ponyid = $request->input('ponyid');
        Pony::ponyStatus($ponyid,2);

        return 1;
    }

    public function edit($ponyid){
        $pony = Pony::find($ponyid);
        return view('celestia.pony.edit',['pony' => $pony]);
    }

    public function post_edit(Request $request){
        $ponyid = $request->input('ponyid');
        $validator = Validator::make($request->all(),[
            'password' => 'required|min:4|max:16',
            'confirm' => 'same:password'
        ]);

        if($validator->fails()){
            return redirect('pony_edit/ponyid/'.$ponyid)
                ->withErrors($validator)
                ->withInput();
        }

        $password = $request->input('password');
        $confirm = $request->input('confirm');

        if($password && $confirm){
            Pony::ponyPassUpdate($ponyid,$password);
            return redirect()->route('celestia_pl')->with('postscript','编辑成功 ponyid:'.$ponyid);
        }
    }
}