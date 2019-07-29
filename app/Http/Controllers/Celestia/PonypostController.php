<?php
/**
 * Created by PhpStorm.
 * User: AppleSparkle
 * Date: 7/23/2018 AD
 * Time: 7:21 PM
 */
namespace App\Http\Controllers\Celestia;
use App\Applejack\XpathUpload;
use App\Http\Controllers\Controller;
use App\Twilight;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;

Class PonypostController extends Controller{
    public function list(Request $request){
        $keyword = $request->input('keyword');
        $search = $request->input('search');
        $type = $request->input('type') ? : 'all';
        $status = $request->input('status') ? : 'all';

        $ponypost = Twilight::twilightSkimLetters($keyword,$search,$type,$status);
        return view('celestia.ponypost.list', [
                'ponypost' => $ponypost,
                'search' => $search,
                'keyword' => $keyword,
                'status' => $status,
                'type' => $type
            ]);
    }

    public function edit($postid){
        $ponypost =Twilight::find($postid);
        return view('celestia.ponypost.edit',['ponypost' => $ponypost]);
    }

    public function post_edit(Request $request){
        $xss_symbol = ["<",">","'","\"","-","?",";",":","script","javascript","alert"];

        $validator = Validator::make($request->all(),[
            'title' => 'required|min:2',
        ])->after(function ($validator) use($request) {
            $thumb = $request->file('thumb');
            if(!$thumb){
                if(!$request->input('fail_image_url')){
                    $validator->errors()->add('thumb', '缩略图 一定要上传(推荐大小:850x400)');
                }
            }
        });

        if($request->file('thumb')){
            $image = Image::make($request->file('thumb'))->resize(850, 400)->insert('images/water_new.jpg','bottom-right')->save('images/thumb/hd_ponyclub_'.UPLOAD_TIME.'.jpg');
            $thumb = $image->dirname.'/'.$image->basename;
            $thumb = str_replace($xss_symbol,' ',$thumb);
        }

        if($validator->fails()){
            $request->session()->flash('fail_image_url',@$thumb ? : $request->input('fail_image_url'));
            return redirect('ponypost_edit/postid/'.$request->input('postid'))
                ->withErrors($validator)
                ->withInput();
        }
        $postid = $request->input('postid');
        $content = $request->input('content');

        if(!$content){
            die('no content provided');
        }else{
            $xu = new XpathUpload($content);
            $content = $xu->upload_image();
        }

        Twilight::twilightModifyLetters($request->all(),$content,@$thumb);

        return redirect()->route('celestia_ppl')->with('postscript','编辑成功！postid:'.$postid);
    }

    public function activate(Request $request){
        $postid = $request->input('postid');
        Twilight::activate($postid);

        return 1;
    }

    public function lock(Request $request){
        $postid = $request->input('postid');
        Twilight::lock($postid);

        return 1;
    }
}