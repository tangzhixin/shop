@extends('layout.admin')
@section('title','添加页面')
@section('body')
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<form action="{{url('Studen/do_add')}}" method="post">
    @csrf
    <table border="1">
        <tr>
            <td>车次</td>
            <td><input type="text" name="train"></td>
        </tr>
        <tr>
            <td>出发地</td>
            <td><input type="text" name="place"></td>
        </tr>
        <tr>
            <td>到达地</td>
            <td><input type="text" name="arrival"></td>
        </tr>
        <tr>
            <td>价钱</td>
            <td><input type="text" name="price"></td>
        </tr>
        <tr>
            <td>张数</td>
            <td><input type="text" name="sheets"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="添加"></td>
        </tr>
    </table>
</form>
</body>
</html>
@endsection

