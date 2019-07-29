<?php
/**
*|--------------------------------------------------------------------------
*| Claim:By the power of Twilight Sparkle and Applejack,
*| I hereby decree this Eloquent is feasible.
*|--------------------------------------------------------------------------
*|
*| Created by PhpStorm.
*| Command Creator: AppleSparkle
*/
namespace App\Agents\Eloquents;
use App\Agents\Interfaces\DotaPonyInterface;
use App\TwijackModel\DotaModel as Dota;
        
Class DotaPonyEloquent implements DotaPonyInterface{
    public $dota_pony;

    function __construct(Dota $dota)
    {
        $this->dota_pony = $dota;
    }

    public function display($search,$attribute,$role,$page = false)
    {
        $dotaPony = $this->dota_pony->status();

        if($search){
            $dotaPony->pony($search);
        }

        if($attribute != 'all attributes'){
            $dotaPony->attribute($attribute);
        }

        if($role != 'all roles'){
            $dotaPony->role($role);
        }
        return $dotaPony = $dotaPony->paginate($page ?: config('constants.page'));
    }
}