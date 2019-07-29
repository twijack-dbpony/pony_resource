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
use App\Agents\Interfaces\GalleryInterface;
use App\TwijackModel\GalleryModel as Gallery;

Class GalleryEloquent implements GalleryInterface{
    public $gallery_m;
    public function __construct(Gallery $gallery)
    {
        $this->gallery_m = $gallery;
    }

    public function operation($id = false)
    {
        if($id){
            return $this->gallery_m::find($id);
        }
    }

    public function postOperation($param)
    {
        if(@$param['id']){
            $this->gallery_m->id($param['id'])->update([
                'name' => $param['name'],
                'author' => $param['author'] ?? 'unknown artist',
//                'pony' => $param['pony'],
                'path' => session('path_image') ?? $param['path_image'],
            ]);
        }else{
            $this->gallery_m::create([
                'name' => $param['name'],
                'author' => $param['author'] ?? 'unknown artist',
//                'pony' => $param['pony'],
                'path' => session('path_image') ?? $param['path_image']
            ]);
        }
    }

    public function display(array $search,$page = false)
    {
        $gallery = $this->gallery_m->direction()
            ->get()->reject(function ($value) use($search){
                if(!in_array($search['name'],explode(',',$value->pony)) && $search['name'] != 'all') return $value;
            });
        return $gallery;
    }
}