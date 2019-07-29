<?php

namespace App\Http\Controllers\Work;

use App\Http\Controllers\Controller;
use App\Model\Work\ServerModel;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;

class ServerController extends Controller
{
    public function display(){
        $ip = request()->get('ip');
        $type = request()->get('type');

        $server = ServerModel::display($ip,$type);
        return view('work.server.display',[
            'server' => $server,
            'ip' => $ip,
            'type' => $type
        ]);
    }

    public function operation($id = false){
        if($id){
            $server = ServerModel::find($id);
            $attachment = ['server' => $server];
        }else{
            $attachment = [];
        }

        return view('work.server.operation',$attachment);
    }

    public function postOperation(Request $request){
        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'password' => 'required',
            'type' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->route('w_pso')->withErrors($validator)->withInput();
        }

        ServerModel::operation($request->all());
        return redirect()->route('w_psd')->with('postscript','nicely done!');
    }
}
