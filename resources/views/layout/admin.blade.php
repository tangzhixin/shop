<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>layout 后台大布局 - Layui</title>
  <link rel="stylesheet" href="/layui/css/layui.css">
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">layui 后台布局</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left">
      <li class="layui-nav-item"><a href="">控制台</a></li>
      <li class="layui-nav-item"><a href="">商品管理</a></li>
      <li class="layui-nav-item"><a href="">用户</a></li>
      <li class="layui-nav-item">
        <a href="javascript:;">其它系统</a>
        <dl class="layui-nav-child">
          <dd><a href="">邮件管理</a></dd>
          <dd><a href="">消息管理</a></dd>
          <dd><a href="">授权管理</a></dd>
        </dl>
      </li>
    </ul>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <a href="javascript:;">
          <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
          贤心
        </a>
        <dl class="layui-nav-child">
          <dd><a href="">基本资料</a></dd>
          <dd><a href="">安全设置</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="">退了</a></li>
    </ul>
  </div>
  
  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
        <li class="layui-nav-item layui-nav-itemed">
          <a class="" href="javascript:;">所有商品</a>
          <dl class="layui-nav-child">
            <dd><a href="{{url('admin/add')}}">添加商品</a></dd>
            <dd><a href="{{url('admin/index')}}">商品列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;">管理员管理</a>
          <dl class="layui-nav-child">
            <dd><a href="{{url('User/add')}}">添加用户</a></dd>
            <dd><a href="{{url('User/index')}}">用户列表</a></dd>
          </dl>
        </li>
          <li class="layui-nav-item">
              <a href="javascript:;">经纬度管理</a>
              <dl class="layui-nav-child">
                  <dd><a href="{{url('LongitudeController')}}">经纬度添加</a></dd>
                  <dd><a href="{{url('Longitude/index')}}">经纬度地址</a></dd>
              </dl>
          </li>
        <li class="layui-nav-item">
          <a href="javascript:;">周考</a>
          <dl class="layui-nav-child">
            <dd><a href="{{url('Studen/add')}}">添加</a></dd>
            <dd><a href="{{url('Studen/index')}}">列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;">用户粉丝列表</a>
          <dl class="layui-nav-child">
            <dd><a href="{{url('')}}">添加</a></dd>
            <dd><a href="{{url('wechat/index')}}">列表</a></dd>
          </dl>
        </li>
        <li class="layui-nav-item">
          <a href="javascript:;">标签管理</a>
          <dl class="layui-nav-child">
            <dd><a href="{{url('wechat/get_label')}}">添加</a></dd>
            <dd><a href="{{url('wechat/get_label_list')}}">列表</a></dd>
          </dl>
        <li class="layui-nav-item">
          <a href="javascript:;">素材管理</a>
          <dl class="layui-nav-child">
            <dd><a href="">添加</a></dd>
            <dd><a href="{{url('wechat/upload_source')}}">列表</a></dd>
          </dl>
        <li class="layui-nav-item">
          <a href="javascript:;">用户管理</a>
          <dl class="layui-nav-child">
            <dd><a href="">添加</a></dd>
            <dd><a href="{{url('agent/user_list')}}">列表</a></dd>
          </dl>

    </div>
  </div>
  
  <div class="layui-body">
    <!-- 内容主体区域 -->
    <div style="padding: 15px;">
    @section('body')
    @show
    </div>
  </div>
  
  <div class="layui-footer">
    <!-- 底部固定区域 -->
    © layui.com - 底部固定区域
  </div>
</div>
<script src="/layui/layui.js"></script>
<script>
//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;
  
});
</script>
</body>
</html>