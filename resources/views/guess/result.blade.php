<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>竞猜结果</title>
</head>
<body>
        @if($obj->end_time<time())
        <h1 align="center">竞猜结果</h1>
        <h2 align="center">
            对阵结果：{{$obj->name}}@if($obj->qsfp == 1)胜@elseif($obj->qsfp == 2)平@elseif($obj->qsfp)负@endif{{$obj->cname}}
        </h2>
        <h2 align="center">
            您的竞猜：{{$obj->name}}@if($obj->sfp == 1)胜@elseif($obj->sfp == 2)平@elseif($obj->sfp)负@endif{{$obj->cname}}
        </h2>
        <h2 align="center">
            @if($obj->qsfp==$obj->sfp)
            结果：恭喜您，猜中了
            @else
            结果：很抱歉，没猜中
            @endif
        </h2>
        @elseif($obj->end_time>time())
        <h2>时间未到，请耐心等待</h2>
        @endif

</body>
</html>