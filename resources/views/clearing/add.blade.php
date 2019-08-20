@extends('layout.admin')
@section('title','表白添加页面')
@section('body')
    <form action="{{url('clearing/do_add')}}" method="post" align="center">
        @csrf
        菜单级别：<select name="jibie" id="">
            <option value="1">一级菜单</option>
            <option value="2">二级菜单</option>
        </select>
        <br/><br/>
        菜单名称：<input type="text" name="mingcheng" id="">
        <br/><br/>
        二级菜单名称：<input type="text" name="erming" id="">
        <br/><br/>
        菜单url:<input type="text" name="url" id="">
        <br/><br/>
        菜单类型：<select name="leixing" id="">
            <option value="view">view</option>
            <option value="click">click</option>
            <option value="text">text</option>
        </select>
        <br/><br/>
        <input type="submit" value="表白">
    </form>
@endsection