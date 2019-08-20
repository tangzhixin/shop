@extends('layout.admin')
@section('title','菜单列表页面')
@section('body')
    <h2 align="center"><a href="{{url('agent/input')}}">菜单添加</a></h2>
    <br/><br/>
    <table border="1" align="center">
        <tr>
            <th>菜单名称</th>
            <th>二级菜单名称</th>
            <th>菜单等级</th>
            <th>菜单类型</th>
            <th>菜单标识</th>
            <th>操作</th>
        </tr>
        @foreach($tangtang as $v)
            <tr>
                <td>{{$v['menu_name']}}</td>
                <td>{{$v['second_menu_name']}}</td>
                <td>
                   {{$v['menu_type']}}
                </td>
                <td>
                    {{$v['event_type']}}
                </td>
                <td>{{$v['menu_tag']}}</td>
                <td>
                    <a href="">菜单删除</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection