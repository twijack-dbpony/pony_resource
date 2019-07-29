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
interface CrowdDetailInterface{
    public function operation($id = false);
    public function postOperation($param);
    public function display($keyword,$level,$page = false);
    public function trash($id);
    public function level_list($name);
}