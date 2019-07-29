<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $current = url()->current();
        $host = request()->getSchemeAndHttpHost();
        if(Str::startsWith($current,$host.'/pony/crowd/display') || Str::startsWith($current,$host.'/pony/crowd/level')){
            $crowd = config('crowd.type')[request()->get('type',1)];

            View::share('crowd_type',$crowd['time']);
            View::share('crowd_level',config('crowd.level_'.$crowd['level']));
        }
        error_reporting(E_ALL ^ E_NOTICE);

        $textBoxIo = false;
        if(request()->get('m') == 'e'){
            View::share('text','编辑');
        }else{
            View::share('text','添加');
        }

        $front = config('constants.textBoxIo');

        foreach($front as $ajts){
        //twilight & applejack
            $target = $host.'/'.$ajts;

            if(Str::startsWith($current,$target)){
                $textBoxIo = true;
            }
        }

        View::share('appName','小马资源站');
        View::share('textBoxIo',$textBoxIo);
        View::share('sidebar',config('constants.sidebar'));
        Resource::withoutWrapping();

        Blade::component('structure.equestria_notice', 'notice');
        Blade::component('work.quiz.choices','choices');

        Blade::if('post', function () { return request('m'); });
        Blade::if('tbi', function () use($textBoxIo) { return $textBoxIo; });

        Blade::component('structure.equestria_alert','alert');
        Blade::component('structure.equestria_tip','tip');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
