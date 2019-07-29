<?php
use App\Http\Resources\GamePonyResource;
use App\TwijackModel\GamePonyModel as GamePony;
/*
|--------------------------------------------------------------------------
| Front Management for HuaDong Ponyclub
|--------------------------------------------------------------------------
|
| let's make Equestria great again!
|
*/

Route::any('/', ['as' => 'manesix_self', 'uses' => 'Manesix\ManesixController@manesix']);
Route::any('login', ['as' => 'manesix_l', 'uses' => 'Manesix\LoginController@login']);
Route::any('post_login', ['as' => 'manesix_pl', 'uses' => 'Manesix\LoginController@post_login']);
Route::any('log_out', ['as' => 'manesix_lo', 'uses' => 'Manesix\LoginController@log_out']);
Route::any('register', ['as' => 'manesix_r', 'uses' => 'Manesix\RegisterController@register']);
Route::any('post_register', ['as' => 'manesix_pr', 'uses' => 'Manesix\RegisterController@post_register']);
Route::any('pony_avatar_upload', ['as' => 'manesix_pau', 'uses' => 'Manesix\RegisterController@pony_avatar_upload']);
Route::any('fav_post', ['as' => 'manesix_fp', 'uses' => 'Manesix\PonypostController@fav_this_post']);

Route::group([],function (){
    Route::any('ponypost_list', ['as' => 'manesix_ppl', 'uses' => 'Manesix\PonypostController@list']);
    Route::any('ponypost_create', ['as' => 'manesix_ppc', 'uses' => 'Manesix\PonypostController@create']);
    Route::any('ponypost_post_create', ['as' => 'manesix_pppc', 'uses' => 'Manesix\PonypostController@post_create']);
    Route::any('manesix_ponypost_edit/postid/{postid}', 'Manesix\PonypostController@edit');
    Route::any('manesix_ponypost_post_edit', ['as' => 'manesix_pppe', 'uses' => 'Manesix\PonypostController@post_edit']);
    Route::any('comment_add',['as' => 'manesix_ca', 'uses' => 'Manesix\CommentController@add']);
    Route::any('manesix_ponypost_self/postid/{postid}', 'Manesix\PonypostController@self');
});

Route::group([],function (){
    Route::any('pony_info',['as' => 'manesix_pi', 'uses' => 'Manesix\PonyController@info']);
    Route::any('pony_info_edit',['as' => 'manesix_pie', 'uses' => 'Manesix\PonyController@edit']);
    Route::any('pony_info_post_edit',['as' => 'manesix_pipe', 'uses' => 'Manesix\PonyController@post_edit']);
});

/*
|--------------------------------------------------------------------------
| My Little Pony Friendship is Magic Resources
|--------------------------------------------------------------------------
|
| Twilight and Applejack have seized this property for military use
|
*/

Route::group([],function (){
    Route::any('pony_display_list',['as' => 'twijack_pdl', 'uses' => 'Twijack\PonyController@allPoniesDisplay']);
    Route::any('pony_comic_list',['as' => 'twijack_pcl', 'uses' => 'Twijack\ComicController@ComicTime']);
    Route::any('pony_comic_self/cid/{cid}','Twijack\ComicController@ComicSelf');
});

Route::group([],function (){
    Route::any('pony_episode_list',['as' => 'twijack_pel', 'uses' => 'Twijack\EpisodeController@allEpisodesDisplay']);
    Route::any('pony_episode_self/eid/{eid}', ['as' => 'twijack_es','uses' => 'Twijack\EpisodeController@episodeSelfDisplay']);
    Route::any('pony_episode_writer', ['as' => 'twijack_ew','uses' => 'Twijack\EpisodeController@writerAggregate']);
    Route::any('pony_bullets/get',['as' => 'twijack_bg','uses' => 'Twijack\BulletController@getBullets']);
    Route::any('pony_bullets/store',['as' => 'twijack_bs','uses' => 'Twijack\BulletController@storeBullets']);
    Route::any('pony_bullets/count',['as' => 'twijack_bc','uses' => 'Twijack\BulletController@countYourBullets']);
});

/*
|--------------------------------------------------------------------------
| Back Management for HuaDong Ponyclub
|--------------------------------------------------------------------------
|
| heads up! ponies!
|
*/

Route::any('back_login', ['as' => 'celestia_l', 'uses' => 'Celestia\LoginController@login']);
Route::any('back_post_login', ['as' => 'celestia_bpl', 'uses' => 'Celestia\LoginController@post_login']);
Route::any('upload_image', ['as' => 'celestia_ui', 'uses' => 'Celestia\CelestiaController@upload_image']);

Route::group(['middleware' => 'cd'],function (){
    Route::any('celestia', ['as' => 'celestia_self', 'uses' => 'Celestia\CelestiaController@celestia']);
    Route::any('back_log_out', ['as' => 'celestia_blo', 'uses' => 'Celestia\LoginController@log_out']);
    Route::any('royalwatcher_list', ['as' => 'celestia_rl', 'uses' => 'Celestia\RoyalwatcherController@list']);
    Route::any('royalwatcher_add', ['as' => 'celestia_ra', 'uses' => 'Celestia\RoyalwatcherController@add']);
    Route::any('royalwatcher_post_add', ['as' => 'celestia_rpa', 'uses' => 'Celestia\RoyalwatcherController@post_add']);
    Route::any('you_are_fired', ['as' => 'celestia_yaf', 'uses' => 'Celestia\RoyalwatcherController@you_are_fired']);
    Route::any('you_are_hired', ['as' => 'celestia_yah', 'uses' => 'Celestia\RoyalwatcherController@you_are_hired']);
    Route::any('setting', ['as' => 'celestia_set', 'uses' => 'Celestia\CelestiaController@personal_setting']);
    Route::any('rw_pass_update', ['as' => 'celestia_rpu', 'uses' => 'Celestia\RoyalwatcherController@rw_pass_update']);
});

Route::group(['middleware' => 'cd'],function (){
    Route::any('pony_list', ['as' => 'celestia_pl', 'uses' => 'Celestia\PonyController@list']);
    Route::any('pony_activate', ['as' => 'celestia_pa', 'uses' => 'Celestia\PonyController@activate']);
    Route::any('pony_lock', ['as' => 'celestia_plo', 'uses' => 'Celestia\PonyController@lock']);
    Route::any('pony_edit/ponyid/{ponyid}', 'Celestia\PonyController@edit');
    Route::any('pony_post_edit', ['as' => 'celestia_ppe', 'uses' => 'Celestia\PonyController@post_edit']);
});

Route::group(['middleware' => 'cd'],function (){
    Route::any('back_ponypost_list', ['as' => 'celestia_ppl', 'uses' => 'Celestia\PonypostController@list']);
    Route::any('ponypost_activate', ['as' => 'celestia_ppa', 'uses' => 'Celestia\PonypostController@activate']);
    Route::any('ponypost_lock', ['as' => 'celestia_pplo', 'uses' => 'Celestia\PonypostController@lock']);
    Route::any('ponypost_edit/postid/{postid}', 'Celestia\PonypostController@edit');
    Route::any('ponypost_post_edit', ['as' => 'celestia_pppe', 'uses' => 'Celestia\PonypostController@post_edit']);
});


Route::prefix('game/pony')->name('gp_')->middleware('cd')->group(function (){
    Route::any('display','Twijack\GamePonyController@display')->name('d');
    Route::any('dotaDisplay','Twijack\GamePonyController@dotaDisplay')->name('dd');
    Route::any('operation/{id?}','Twijack\GamePonyController@operation')->name('op');
    Route::any('postOperation','Twijack\GamePonyController@postOperation')->name('po');
});

Route::prefix('gallery/pony')->name('gap_')->middleware('cd')->group(function (){
    Route::any('display','Twijack\GalleryController@display')->name('d');
    Route::any('operation/{id?}','Twijack\GalleryController@operation')->name('op');
    Route::any('postOperation','Twijack\GalleryController@postOperation')->name('po');
});

Route::get('game/pony/detail/{id}', function ($id) { return new GamePonyResource(GamePony::find($id));});

/*
|--------------------------------------------------------------------------
| Work-related Module
|--------------------------------------------------------------------------
|
| Egghead Warning!
|i
*/

Route::prefix('pony/server')->middleware('cd')->group(function (){
    Route::any('display',['as' => 'w_psd', 'uses' => 'Work\ServerController@display']);
    Route::any('operation/{id?}',['as' => 'w_pso', 'uses' => 'Work\ServerController@operation']);
    Route::any('postOperation',['as' => 'w_spo', 'uses' => 'Work\ServerController@postOperation']);
});

Route::prefix('pony/bill')->middleware('cd')->group(function (){
    Route::any('display',['as' => 'd_psd', 'uses' => 'Daily\BillController@display']);
    Route::any('chart',['as' => 'd_pbc', 'uses' => 'Daily\BillController@chart']);
    Route::any('chartChild/{date}',['as' => 'd_bcc', 'uses' => 'Daily\BillController@chartChild']);
    Route::any('operation/{id?}',['as' => 'd_pso', 'uses' => 'Daily\BillController@operation']);
    Route::any('postOperation',['as' => 'd_spo', 'uses' => 'Daily\BillController@postOperation']);
});

Route::prefix('pony/quiz')->middleware('cd')->group(function (){
    Route::any('display',['as' => 'q_psd', 'uses' => 'Work\QuizController@display']);
    Route::any('allQuizzes',['as' => 'q_paq', 'uses' => 'Work\QuizController@allQuizzes']);
    Route::any('quiz',['as' => 'q_pq', 'uses' => 'Work\QuizController@quiz']);
    Route::any('quizSpotter',['as' => 'q_pqs', 'uses' => 'Work\QuizController@quizSpotter']);
    Route::any('operation/{id?}',['as' => 'q_pso', 'uses' => 'Work\QuizController@operation']);
    Route::any('postOperation',['as' => 'q_spo', 'uses' => 'Work\QuizController@postOperation']);
});

Route::prefix('pony/crowd/detail')->name('pcd_')->middleware('cd')->group(function (){
    Route::any('display','Work\CrowdDetailController@display')->name('d');
    Route::any('operation/{id?}','Work\CrowdDetailController@operation')->name('op');
    Route::any('postOperation','Work\CrowdDetailController@postOperation')->name('po');
    Route::any('trash','Work\CrowdDetailController@trash')->name('t');
    Route::any('level_list','Work\CrowdDetailController@levelList')->name('ll');
});

Route::prefix('pony/crowd')->name('pc_')->middleware('cd')->group(function (){
    Route::any('display','Work\CrowdController@display')->name('d');
    Route::any('excel','Work\CrowdController@excel')->name('e');
    Route::any('response','Work\CrowdController@response')->name('r');
    Route::any('region','Work\CrowdController@region')->name('re');
    Route::any('level','Work\CrowdController@level')->name('l');
});

Route::fallback(function () { return view('errors.404'); });
