<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Http\Request;
use Illuminate\Http\Input;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Log;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //
        Log::info('Showing middle: ' . $request->cookie('lang'));

        if($request->cookie('lang')) 
            App::setLocale($request->cookie('lang'));
        else {
            // default
            App::setLocale('sr');
            //session()->put('lang', 'sr');
            //$_COOKIE['lang'] = 'sr';
        }
        
        return $next($request);
    }
}
