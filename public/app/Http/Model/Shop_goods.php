<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Shop_goods extends Model
{
    // 与模型关联的表名
    protected $table='shop_goods';
    protected $primaryKey='goods_id';
    // 指示模型是否自动维护时间戳
    public $timestamps=false;

    // 模型的链接名称
    protected $connection='shop';

}
