@extends('layout.admin')
@section('title','修改页面')
@section('body')
    <form class="layui-form" action="{{url('admin/do_update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$obj->id}}">
        <div class="layui-form-item layui-col-md4">
            <label class="layui-form-label">商品名称</label>
            <div class="layui-input-block">
                <input type="text" name="goods_name" required value="{{$obj->goods_name}}" lay-verify="required" placeholder="请输入名称" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item layui-col-md4">
            <label class="layui-form-label">商品图片</label>
            <div class="layui-input-inline">
                <input type="file" name="goods_pic" required value="{{$obj->goods_pic}}" lay-verify="required" placeholder="请输入图片" autocomplete="off" class="layui-input">
                <img src="{{$obj->goods_pic}}" alt="" width="50px;" height="50px;">
            </div>
        </div>
        <div class="layui-form-item layui-col-md4">
            <label class="layui-form-label">商品价格</label>
            <div class="layui-input-inline">
                <input type="text" name="goods_price" required value="{{$obj->goods_price}}" lay-verify="required" placeholder="请输入价格" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo">立即修改</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>

    <script>
        //Demo
        layui.use('form', function(){
            var form = layui.form;

            //监听提交
            form.on('submit(formDemo)', function(data){
                layer.msg(JSON.stringify(data.field));
                return false;
            });
        });
    </script>
@endsection