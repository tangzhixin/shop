<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<form action="{{url('diaoyan/login_do')}}" method="post">
		@csrf
		用户名:<input type="text" name="user"><p>
		  密码:<input type="password" name="pwd"><p>
		<input type="submit" value="登录">
	</form>
</body>
</html>