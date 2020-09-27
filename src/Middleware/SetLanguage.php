<?php

namespace Nolin\Laratools\Middleware;

use Closure;

class SetLanguage
{
    protected $jwt;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //檢查傳入的語系是否有支援
        $checkSupport = in_array($request->header('content-language'), array_keys(config('app.supported_locales')));

        if ($checkSupport) {
            //有支援則使用header的語系
            $lang = $request->header('content-language');
        } else {
            //無支援則使用系統預設
            $lang = config('app.locale');
        }

        app()->setLocale($lang);

        return $next($request);
    }
}
