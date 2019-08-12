<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加竞猜页面</title>
</head>
<body>
    < <form action="{{url('guess/gue_index')}}" method="get">
        @csrf
        <h2 align="center">我要竞猜</h2>
        <h3 align="center">{{$obj->name}}VS{{$obj->cname}}</h3>
        <h3 align="center">
            <input type="radio" name="qsfp" value="1">胜
            <input type="radio" name="qsfp" value="2">平
            <input type="radio" name="qsfp" value="3">负
        </h3>
        <h2 align="center"><input type="submit" value="提交"></h2>
    </form>
</body>
</html>