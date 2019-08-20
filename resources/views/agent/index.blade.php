@extends('layout.admin')
@section('title','菜单列表页面')
@section('body')
    <h2 align="center"><a href="{{url('agent/input')}}">菜单添加</a></h2>
    <br/><br/>
    <table border="1" align="center">
        <tr>
            <th>菜单编号</th>
            <th>菜单名称</th>
            <th>二级菜单名称</th>
            <th>菜单等级</th>
            <th>菜单类型</th>
            <th>菜单标识</th>
            <th>操作</th>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->menu_name}}</td>
            <td>{{$v->second_menu_name}}</td>
            <td>
                @if(($v->menu_type)==1)
                一级菜单
                @elseif(($v->menu_type)==2)
                二级菜单
                @elseif(($v->menu_type)==3)
                三级菜单
                @endif
            </td>
            <td>
              {{$v->event_type}}
            </td>
            <td>{{$v->menu_tag}}</td>
            <td>
                <a href="{{url('agent/delete')}}?id={{$v->id}}">菜单删除</a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection    