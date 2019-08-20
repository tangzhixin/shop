@extends('layout.admin')
@section('title','添加菜单页面')
@section('body')
    <center>
        <form action="{{url('agent/do_input')}}" method="post">
            @csrf
            菜单级别：<select name="menu_type" id="aa">
                <option value="1">一级菜单</option>
                <option value="2">二级菜单</option>
            </select>
            <br/><br/>
            菜单名称：<input type="text" name="menu_name" id="">
            <br/><br/>
            二级菜单名称：<input type="text" name="second_menu_name" id="bb">
            <br/><br/>
            菜单标识：<input type="text" name="menu_tag" id="">
            <br/><br/>
            菜单类型：<select name="event_type" id="">
                <option>view</option>
                <option>click</option>
                <option>return</option>
                <option>data</option>
                <option>obj</option>
            </select>
            <br/><br/>
            <input type="submit" value="添加">
        </form>

    </center>
@endsection