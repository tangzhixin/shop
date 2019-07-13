@extends('layout.admin')
@section('title','添加页面')
@section('body')
<form class="layui-form" action="{{url('admin/do_add')}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="layui-form-item layui-col-md4">
    <label class="layui-form-label">商品名称</label>
    <div class="layui-input-block">
      <input type="text" name="goods_name" required  lay-verify="required" placeholder="请输入名称" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item layui-col-md4">
    <label class="layui-form-label">商品图片</label>
    <div class="layui-input-inline">
      <input type="file" name="goods_pic" required lay-verify="required" placeholder="请输入图片" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item layui-col-md4">
    <label class="layui-form-label">商品价格</label>
    <div class="layui-input-inline">
      <input type="text" name="goods_price" required lay-verify="required" placeholder="请输入价格" autocomplete="off" class="layui-input">
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
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