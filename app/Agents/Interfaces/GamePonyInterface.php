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
interface GamePonyInterface{
    public function newPonyInTown($param);
    public function operation($id = false);
    public function display(array $search,$page = false);
    public function count(array $search);
    public function episode(array $ponyid);
}