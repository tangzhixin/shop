@extends('layout.admin')
@section('title','我的留言页面')
@section('body')
    <h1 align="center">我的留言内容</h1>
    <br/><br/>
    <table align="center" border="1">
        <tr>
            <th>编号</th>
            <th>内容</th>
            <th>名称</th>
            <th>操作</th>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->liya}}</td>
            <td>{{$v->name}}</td>
            <td>
                <a href="{{url('zhou/list')}}">返回上一层</a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection