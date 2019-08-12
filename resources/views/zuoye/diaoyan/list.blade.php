<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<table border="1">
		<tr>
			<th>调研项目</th>
			<th>操作</th>
		</tr>
		@foreach($data as $v)
		<tr>
			<td>{{$v->probject}}</td>
			<td>
				<a href="{{url('monthly')}}?pid={{$v->pid}}">启用</a>
				&ensp;||&ensp;
				<a href="{{url('diaoyan/del')}}?pid={{$v->pid}}">删除</a>
			</td>
		</tr>
		@endforeach
	</table>
	{{$data->links()}}
</body>
</html>