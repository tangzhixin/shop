<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<form action="{{url('diaoyan/add_probject_do')}}" method="post">
		@csrf
		调研项目：<input type="text" name="probject"><p>
		<input type="submit" value="添加调研">
	</form>
</body>
</html>