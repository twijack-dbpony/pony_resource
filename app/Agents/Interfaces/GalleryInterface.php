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
interface GalleryInterface{
    public function operation($id = false);
    public function postOperation($param);
    public function display(array $search,$page = false);
}