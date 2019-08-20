@extends('layout.admin')
@section('title','列表页面')
@section('body')
    <h2 align="center"><a href="{{url('zhou/index')}}">我的留言</a></h2>
    <br/><br/>
    <table align="center" border="1">
        <tr>
            <th>编号</th>
            <th>用户名称</th>
            <th>操作</th>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->nickname}}</td>
            <td>
                <a href="{{url('zhou/add')}}?uid={{$v->id}}">留言</a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection