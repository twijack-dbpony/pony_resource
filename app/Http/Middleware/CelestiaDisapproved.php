<?php
/**
 * Created by PhpStorm.
 * User: AppleSparkle
 * Date: 7/23/2018 AD
 * Time: 3:57 PM
 */
namespace App\Http\Middleware;

use Closure;

class CelestiaDisapproved{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->session()->get('rid')) {
            $request->session()->put('LunaKnowsYourHistory',url()->full());
            return redirect()->route('celestia_l');
        }else{
            return $next($request);
        }
    }
}