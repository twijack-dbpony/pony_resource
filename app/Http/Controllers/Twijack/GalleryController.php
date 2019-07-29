<?php

namespace App\Http\Controllers\Twijack;

use App\Http\Requests\GalleryRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Agents\Interfaces\GalleryInterface;
use Illuminate\Support\Arr;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class GalleryController extends Controller
{
    public $Gallery;

    public function __construct(GalleryInterface $Gallery)
    {
        $this->Gallery = $Gallery;
    }

    public function operation($id = false){
        $pony = $this->Gallery->operation($id);
        return view('twijack.gallery.operation',['pony' => $pony, 'id' => $id]);
    }

    public function postOperation(GalleryRequest $request){
        $request->validated();
        $this->Gallery->postOperation($request->all());
        return redirect()->route('gap_d')->with('postscript','Operation Completed Successfully! --Princess Luna');
    }

    public function display(Request $request){
        $name = $request->input('name','all');
        $param = ['name' => $name];
        $perPage = config('constants.page');

        $page = $request->input('page',1);
        $offset = ($page-1) * $perPage;

        $pony = $this->Gallery->display($param);

        $display = array_slice($pony->toArray(),$offset,$perPage);

        $gallery_display = new Paginator($display,$pony->count(),$perPage,$page,[
            'path'  => $request->url(),
            'query' => $request->query(),
        ]);

        $attachment = Arr::add($param,'pony',$gallery_display);
        return view('twijack.gallery.display',$attachment);
    }
}
