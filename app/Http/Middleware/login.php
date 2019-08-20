<?php

namespace App\Http\Middleware;

use Closure;

class login
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
        $loginInfo=session()->has('loginInfo');
        if(empty($loginInfo)){
//            echo "登录成功";
        }else{
            return redirect('admin/login');
        }
        $response=$next($request);

        return $response;
    }
}
