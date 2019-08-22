@extends('layout.admin')
@section('title','表白列表页面')
@section('body')
    <table align="center" border="1">
        <tr>
            <th>编号</th>
            <th>级别</th>
            <th>名称</th>
            <th>二级名称</th>
            <th>URL</th>
            <th>类型</th>
            <th>操作</th>
        </tr>
        @foreach($obj as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->jibie}}</td>
            <td>{{$v->mingcheng}}</td>
            <td>{{$v->erming}}</td>
            <td>{{$v->url}}</td>
            <td>{{$v->leixing}}</td>
            <td>
                <a href="{{url('clearing/tang')}}?id={{$v->id}}">推送</a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection