<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/admin/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="../public/css/base.css">  -->
    <link rel="stylesheet" type="text/css" href="/admin/css/b_login.css">
    <title>后台登录页面</title>
</head>
<body>
<div class="login">
    <div >
        <h2>注册管理系统</h2>
        <form action="{{url('admin/do_register')}}" method="post" class="form-horizontal">
        @csrf
        <!-- 让表单在一行中显示form-horizontal -->
            <div class="form-group">
                <label  class="col-lg-1 control-label">用户名</label>
                <div class="col-lg-4">
                    <input type="text" name="name" class="form-control">
                </div>
            </div>
            <div class="form-group"></div>
            <div class="form-group"></div>

            <div class="form-group">
                <label for="password" class="col-lg-1 control-label">密&nbsp;&nbsp;&nbsp;&nbsp;码</label>
                <div class="col-lg-4">
                    <input type="password" name="password" class="form-control" >
                </div>
            </div>
            <div class="form-group"></div>
            <!-- <div class="form-group"></div> -->

            <div class="form-group">
                <div class="col-lg-11 col-lg-offset-1">
		                <span class="checkbox ">
		                    <label><input type="checkbox" name="" class="checkbox-inline">记住我</label>
		                </span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-4 col-lg-offset-1">
                    <input type="submit" value="注册" class="btn btn-danger btn-lg">
                    <span class="text"></span>
                </div>

            </div>

        </form>
    </div>
    <div class="rightpic">
        <div id="container">
            <!-- <img src="picture/1.jpg" alt="" width="500px" height="330px"> -->
        </div>
    </div>
</div>

<script src="/admin/public/js/jquery-3.1.1.min.js"></script>
<script src="/admin/bootstrap/js/bootstrap.min.js"></script>
<script src="/admin/public/js/delaunay.js"></script>
<script src="/admin/public/js/TweenMax.js"></script>
<script src="/admin/js/effect.js"></script>
<script src="/admin/js/b_login.js"></script>
</body>
</html>