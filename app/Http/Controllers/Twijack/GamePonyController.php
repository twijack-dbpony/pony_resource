<?php

namespace App\Http\Controllers\Twijack;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Agents\Interfaces\GamePonyInterface;
use App\Agents\Interfaces\DotaPonyInterface;
use App\Http\Requests\GamePonyRequest;
use Illuminate\Support\Arr;

class GamePonyController extends Controller
{
    public $GamePony;
    public $Dota;

    public function __construct(GamePonyInterface $GamePony, DotaPonyInterface $Dota)
    {
        $this->GamePony = $GamePony;
        $this->Dota = $Dota;
    }

    public function operation($id = false){
        $pony = $this->GamePony->operation($id);
        return view('twijack.gamePony.operation',['pony' => $pony, 'id' => $id]);
    }

    public function postOperation(GamePonyRequest $request){
        $request->validated();
        $this->GamePony->newPonyInTown($request->all());
        return redirect()->route('gp_d')->with('postscript','Operation Completed Successfully! --Princess Luna');
    }

    public function display(Request $request){
        $name = $request->input('name');

        $sex = $request->input('sex','all');
        $race = $request->input('race','all');
        $location = $request->input('location','all');
        $own = $request->input('own','all');

        $param = [
            'name' => $name,
            'sex' => $sex,
            'race' => $race,
            'location' => $location,
            'own' => $own
        ];

        $pony = $this->GamePony->display($param);
        $count = $this->GamePony->count($param);

        $param = Arr::add($param,'pony',$pony);
        $attachment = Arr::add($param,'count',$count);
        return view('twijack.gamePony.display',$attachment);
    }

    public function dotaDisplay(Request $request){
        $search = $request->input('search');
        $attribute = $request->input('attribute','all attributes');
        $role = $request->input('role','all roles');

        $dota = $this->Dota->display($search,$attribute,$role);
        return view('twijack.dota.display',compact('dota','search','attribute','role'));
    }
}
