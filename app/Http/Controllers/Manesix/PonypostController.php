<?php
/**
 * Created by PhpStorm.
 * User: AppleSparkle
 * Date: 8/2/18
 * Time: 11:48 AM
 */
namespace App\Http\Controllers\Manesix;

use App\Applejack\XpathUpload;
use App\Fluttershy;
use App\Http\Controllers\Controller;
use App\Rarity;
use App\Pinkie;
use App\Twilight;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Applejack\UserAgentIp;

class PonypostController extends Controller{
    public function list(Request $request){
        $type = $request->input('type','all');
        $sort = $request->input('sort','created_time');
        $keyword = $request->input('search_global');
        $ponyid = session('ponyid');

        $ponypost = Twilight::twilightSkimLetters($keyword,'',$type,1,'f_list',$sort,$ponyid,5);

        $count_by_type = Twilight::sortByTwilight();

        $latest_trend=Pinkie::latestPinkieTrend();

        foreach($count_by_type as $ajts){
        //twijack best cp around!
            $ponypost_type[$ajts['type']] = $ajts['count'];
        }
        $ponypost_sum = array_sum($ponypost_type);
        if($ponyid) {
            $fav = Rarity::rarityOnTheCase($ponyid);

            if($fav){
                $fav = array_column($fav,'postid');
            }else{
                $fav = ['0'];
            }
        }else{
            $fav = ['0'];
        }

        return view('manesix.ponypost.list',[
            'ponypost' => $ponypost,
            'type' => $type,
            'ponypost_sum' => $ponypost_sum,
            'ponypost_type' => $ponypost_type,
            'sort' => $sort,
            'latest_trend' => $latest_trend,
            'fav' => $fav,
            'keyword' => $keyword
        ]);
    }

    public function create(){
        return view('manesix.ponypost.create');
    }

    public function post_create(Request $request){
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
            return redirect()
                    ->route('manesix_ppc')
                    ->withErrors($validator)
                    ->withInput();
        }

        $content = $request->input('content');
        if(!$content){
            die('no content provided');
        }else{
            $xu = new XpathUpload($content);
            $content = $xu->upload_image();
        }
        Twilight::twilightSendLetters($request->all(),$content,@$thumb);

        return redirect()->route('manesix_ppl')->with('postscript','文章发表成功！请等待管理员审核！');
    }

    public function edit($postid){
        $ponypost = Twilight::find($postid);
        return view('manesix.ponypost.edit',['ponypost' => $ponypost]);
    }

    public function post_edit(Request $request){
        $postid = $request->input('postid');

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
            return redirect('manesix_ponypost_edit/postid/'.$request->input('postid'))
                ->withErrors($validator)
                ->withInput();
        }
        $content = $request->input('content');
        if(!$content){
            die('no content provided');
        }else{
            $xu = new XpathUpload($content);
            $content = $xu->upload_image();
        }
        Twilight::twilightModifyLetters($request->all(),$content,@$thumb);

        return redirect('manesix_ponypost_edit/postid/'.$postid)->with('postscript','文章编辑成功！请等待管理员审核！');
    }

    public function self($postid,UserAgentIp $uai){
        $phone_info = $uai->phone_info();
        $info = $uai->information();
        $ponyid = session('ponyid');

        Fluttershy::fluttershyFlyBy($postid,$info,session()->all());
        Twilight::incrementByTwilight($postid,'click');

        $ponypost = Twilight::twilightOpenLetters($postid);
        $comment = Pinkie::pinkieCommentDisplay($postid);
        $latest_trend = Pinkie::latestPinkieTrend();

        if($ponyid) {
            $fav = Rarity::rarityOnTheCase($ponyid);

            if($fav){
                $fav = array_column($fav,'postid');
            }else{
                $fav = ['0'];
            }
        }else{
            $fav = ['0'];
        }

        return view('manesix.ponypost.self',[
            'ponypost' => $ponypost,
            'comment' => $comment,
            'phone_info' => $phone_info,
            'latest_trend' => $latest_trend,
            'fav' => $fav,
        ]);
    }

    public function fav_this_post(Request $request,UserAgentIp $uai){
        $postid = $request->input('postid');
        $mode = $request->input('mode');

        $ponyid = $request->session()->get('ponyid');
        $ponyname = $request->session()->get('ponyname');

        $rarity = Rarity::ruleOfRarity($request->all(),$ponyid,$ponyname);

        if(!$ponyid){
            echo 1;
            exit;
        }

        if($mode == 'fav'){
            if($rarity){
                echo 2;
                exit;
            }

            $ua_info = $uai->information();
            Rarity::rarityLovesThis($ua_info,$postid,$ponyid,$ponyname);
        }else{
            if(!$rarity){
                echo 3;
                exit;
            }

            Rarity::rarityHatesThis($postid,$ponyid);
        }

        $twilight = Twilight::favSummaryByTwilight($postid,$mode);
        echo $twilight;
    }
}