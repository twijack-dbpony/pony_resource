<?php
/**
*|--------------------------------------------------------------------------
*| Claim:By the power of Twilight Sparkle and Applejack,
*| I hereby decree this Interface is feasible.
*|--------------------------------------------------------------------------
*|
*| Created by PhpStorm.
*| Command Creator: AppleSparkle
*/
namespace App\Agents\Interfaces;
interface CrowdInterface{
    public function operation($parameter,$type);
    public function display($keyword,$search,$type,$level,$page = false);
    public function response($parameter);
    public function regionStats($page = false);
    public function levelStats($type,$page = false);
}