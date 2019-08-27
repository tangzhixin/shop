<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Tools\Wechat;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->call(function(){
            $redis=new \Redis();
            $redis->connect('127.0.0.1','6379');
            $app=app('wechat.official_account');
           // 业务逻辑
          $price=file_get_contents('http://www.tangwenhu.vip/price/index');
          $price_info=json_decode($price,1);
          foreach($price_info['result'] as $v){
              if($this->redis->exists($v['city'].'信息')){
                  $redis_info=json_decode($this->redis->get($v['city'].'信息'),1);
                  foreach($v as $k=>$vv){
                      if($vv !=$redis_info[$k]){
                          //推送模板信息
                          $openid_info=$app->user->list($nextOpenId=null);
                      }
                  }
              }
          }
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
