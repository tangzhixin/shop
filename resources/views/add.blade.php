<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加页面</title>
</head>
<body>
    @if($errors->any())
        @foreach ($errors->all() as $error)
            {{$error}}
        @endforeach
    @endif
    <form action={{url('/student/save')}} method="post">
            @csrf
        <table>
            <tr>
                <td>姓名</td>
                <td>
                    <input type="text" name="name">
                </td>
            </tr>
            <tr>
                <td>年龄</td>
                <td>
                    <input type="text" name="age">
                </td>
            </tr>
            <tr>
                <td>性别</td>
                <td>
                    <input type="radio" name="ext" value="0">男
                    <input type="radio" name="ext" value="1">女
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="添加">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
