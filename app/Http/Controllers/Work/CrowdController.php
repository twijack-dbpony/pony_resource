<?php

namespace App\Http\Controllers\Work;

use App\Model\Work\CrowdModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Agents\Interfaces\CrowdInterface;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class CrowdController extends Controller
{
    public $crowd;
    public function __construct(CrowdInterface $crowd)
    {
        $this->crowd = $crowd;
    }

    public function excel(){
        //18551644885 218,150
        //13858179282 150
        $reader = new Xlsx();
//        $spreadsheet = $reader->load('first.xlsx');
//        $spreadsheet = $reader->load('second.xlsx');
        $spreadsheet = $reader->load('crowd_second.xlsx');
//        $spreadsheet = $reader->load('crowd_second.xlsx');
        $target = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        foreach($target as $aj => $ts){
        //twilight & applejack
            if($aj == 1) continue;
            $this->crowd->operation($ts,2);
//            $this->crowd->operation($ts,2);
        }
        dump('Princess Luna was impressed!');
    }

    public function display(Request $request){
        $keyword = $request->input('keyword');
        $search = $request->input('search');

        $type = $request->input('type',1);
        $level = $request->input('level','all');

        $crowd = $this->crowd->display($keyword,$search,$type,$level);
        return view('work.crowd_list.display',compact('crowd','keyword','type','level','search'));
    }

    public function response(Request $request){
        return $this->crowd->response($request->all());
    }

    public function region(){
        $region = $this->crowd->regionStats();
        return view('work.crowd_list.region',compact('region'));
    }

    public function level(Request $request){
        $type = $request->input('type',1);
        $level = $this->crowd->levelStats($type);
        return view('work.crowd_list.level',compact('level','type'));
    }
}
