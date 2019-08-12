<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加竞猜</title>
</head>
<body>
        <h2>添加竞猜球队</h2>
    <form action="{{url('guess/do_add')}}" method="post">
        @csrf
        <table>
            <tr>
                <td>
                    <input type="text" name="name" id="">VS <input type="text" name="cname" id="">
                </td>
            </tr>
            <tr>
                <td>
                    结束竞猜时间： <input type="time" name="end_time" id="">
                </td>
            </tr>

                <td align="center">
                    <input type="submit" value="添加">
                </td>

        </table>
    </form>
</body>
</html>