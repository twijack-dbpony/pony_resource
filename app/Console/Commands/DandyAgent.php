<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DandyAgent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:agent {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exert JohnInterface and JohnEloquent to lessen the code weight in both JohnController and JohnModel';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $prefix = ucfirst($this->argument('name'));
        $interface = '<?php
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
interface '.$prefix.'Interface{
                
}';
        $eloquent = '<?php
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
use App\Agents\Interfaces\\'.$prefix.'Interface;
        
Class '.$prefix.'Eloquent implements '.$prefix.'Interface{
            
}';
        $appBind = '        $this->app->bind(\'App\Agents\Interfaces\\'.$prefix.'Interface\', \'App\Agents\Eloquents\\'.$prefix.'Eloquent\');';

        $directory = config('constants.agentDir');
        $AgentFile = config('constants.agentFile');
        $AgentPath = config('constants.agentPath');

        $providerPath = app_path($AgentPath.$AgentFile.'.php');
        $interface_path = $directory[0].'/'.$directory[1].'/'.$prefix;
        $eloquent_path = $directory[0].'/'.$directory[2].'/'.$prefix;

        foreach($directory as $aj => $ts){
            if($aj == 0){
                $path = app_path($ts);
            }else{
                $path = app_path($directory[0].'/'.$ts);
            }

            if(!File::exists($path)) {
                File::makeDirectory($path,0777,true,true);
            }
        }

        file_put_contents(app_path($interface_path.'Eloquent.php'),$eloquent);
        file_put_contents(app_path($eloquent_path.'Interface.php'),$interface);

        if(!File::exists($providerPath)){
            Artisan::call('make:provider '.$AgentFile);
        }

        $agentInfo = file($providerPath, FILE_IGNORE_NEW_LINES);

        for ($i = 0; $i < count($agentInfo); $i ++){
            if(Str::contains($agentInfo[$i],'register')){
                $position = $i + 3;
            }
        }
        $agent = collect($agentInfo);
        $core = $agent->splice($position);

        $core->prepend($appBind);
        $jobDone = $agent->merge($core)->all();

        $fileHandler = fopen($providerPath,'w');
        fwrite($fileHandler,implode("\n",$jobDone));
        fclose($fileHandler);

        $this->info('Interface&Eloquent created successfully.');
    }
}
