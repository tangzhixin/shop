@extends('layout.admin')
@section('title','后台列表')
@section('body')
<center>
    <h2><a href="{{url('admin/add')}}" class="layui-btn">添加</a></h2>
</center>
<link rel="stylesheet" href="/css/page.css">

<form action="{{url('admin/index')}}" medhod="get" align="center">
    @csrf
    商品名称:<input type="text" name="search" value="">
    <input type="submit" class="layui-btn layui-btn-radius layui-btn-normal" value="搜索">
</form>
    <table class="layui-table">
        <colgroup>
            <col width="150">
            <col width="200">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th>ID</th>
            <th>商品名称</th>
            <th>图片</th>
            <th>价格</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($admin as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->goods_name}}</td>
            <td>
                <img src="{{$v->goods_pic}}" alt="">
            </td>
            <td>{{$v->goods_price}}</td>
            <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
            <td>
                <a href="/admin/del?id={{$v->id}}" class="layui-btn">删除</a><a href=""></a>
                <a href="/admin/update?id={{$v->id}}" class="layui-btn">修改</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <center>
    {{ $admin->appends(['search'=>$search])->links()}}
</center>
@endsection