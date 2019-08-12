<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<form action="{{url('diaoyan/add_question_do')}}" method="post">
		@csrf
		调研问题:<input type="text" name="question"><p>
		问题选项:<input type="radio" name="type" value="1">单选
				<input type="radio" name="type" value="2">多选
				<input type="hidden" name="pid" value="{{$pid}}"><p>
				<input type="submit" value="添加问题">
	</form>
</body>
</html>