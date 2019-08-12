<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>留言板</h1>
    <form action="{{url('monthly/add')}}" method="post">
        @csrf
        <table>
            <tr>
                内容
                <td>
                    <textarea name="title" id="" cols="50" rows="10">

                    </textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="发布">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>


<h1>留言列表</h1>
<link rel="stylesheet" href="/css/page.css">
<form action="{{url('monthly/index')}}" method="get">
    姓名:<input type="text" name="name" value="">
    <input type="submit" value="搜索">
</form>
<table border="1">
    <tr>
        <th>编号</th>
        <th>留言内容</th>
        <th>姓名</th>
        <th>时间</th>
        <th>操作</th>
    </tr>
    @foreach($obj as $v)
    <tr>
        <td>{{$v->id}}</td>
        <td>{{$v->title}}</td>
        <td>{{$v->name}}</td>
        <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
        <td>
            @if($v->add_time<time())
            <a href="/monthly/del?id={{$v->id}}">删除</a>
            @else

            @endif
        </td>
    </tr>
    @endforeach
    <tr>
        <td colspan="5">{{$obj->appends(['name'=>$name])->links()}}</td>
    </tr>
</table>