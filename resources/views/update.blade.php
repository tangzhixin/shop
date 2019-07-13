<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>修改页面</title>
</head>
<body>
    <form action={{url('/student/updateadd')}} method="post">
            @csrf
        <input type="hidden" name="id" value="{{$res->id}}">
        <table>
            <tr>
                <td>姓名</td>
                <td>
                    <input type="text" name="name" value="{{$res->name}}">
                </td>
            </tr>
            <tr>
                <td>年龄</td>
                <td>
                    <input type="text" name="age" value="{{$res->age}}">
                </td>
            </tr>
            <tr>
                <td>性别</td>
                <td>

                @if($res->ext==0)
                    <input type="radio" name="ext" value="0" checked>男
                    <input type="radio" name="ext" value="1" >女
                @else
                <input type="radio" name="ext" value="0">男
                    <input type="radio" name="ext" value="1" checked>女
                @endif
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="修改">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>