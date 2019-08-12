<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<form action="{{url('diaoyan/add_option_do')}}" method="post">
		@csrf
		A：<input type="text" name="a"><p>
		B：<input type="text" name="b"><p>
		C：<input type="text" name="c"><p>
		D：<input type="text" name="d"><p>
		<input type="hidden" name="qid" value="{{$qid}}">
		<input type="submit" value="添加">
	</form>
</body>
</html>