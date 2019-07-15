<?php

namespace App\Http\Middleware;

use Closure;

class Update
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
//        $h=date('H');
//        if( $h<12 || $h>17){
//            echo "商品修改需要在【9:00-17:00】才可以进入】"die;
//        }
        // 之前的时间
        $time=time();
        $a=strtotime('9:00:00');
        $b=strtotime('17:00:00');
        if($time<$a){
            echo "还没到9:00,商品修改需要在【9:00-17:00】才可以进入】";die;
        }else if($time>$b){
            echo "已经过了17:00了，商品修改需要在【9:00-17:00】才可以进入】";die;
        }
        return $next($request);
    }
}

