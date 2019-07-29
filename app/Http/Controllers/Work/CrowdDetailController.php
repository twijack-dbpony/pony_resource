<?php

namespace App\Http\Controllers\Work;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Agents\Interfaces\CrowdDetailInterface;
use App\Http\Requests\CrowdDetailRequest;

class CrowdDetailController extends Controller
{
    public $crowd;
    public function __construct(CrowdDetailInterface $crowd)
    {
        $this->crowd = $crowd;
    }

    public function operation($id = false){
        $crowd = $this->crowd->operation($id);
        return view('work.crowd.operation',compact('id','crowd'));
    }

    public function postOperation(CrowdDetailRequest $request){
        $request->validated();
        $this->crowd->postOperation($request->all());
        return redirect()->route('pcd_d')->with('postscript','Operation Completed Successfully! --Princess Luna');
    }

    public function display(Request $request){
        $level = $request->input('level','all');
        $keyword = $request->input('search');

        $crowd = $this->crowd->display($keyword,$level);
        return view('work.crowd.display',compact('crowd','keyword','level'));
    }

    public function trash(Request $request){
        return $this->crowd->trash($request->input('id'));
    }

    public function levelList(Request $request){
        return $this->crowd->level_list($request->input('name'));
    }
}
