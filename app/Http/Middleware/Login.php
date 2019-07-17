<?php

namespace App\Http\Middleware;

use Closure;

class Login
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
        //前置
        // dd($result);
        if($request->session()->has('userInfo')){
            echo "登陆成功 !";
            // redirect('student/index');
        }


         $response= $next($request);
        // 后置
        echo 22222;
        // return $next($request);
        return $response;
    }
}
