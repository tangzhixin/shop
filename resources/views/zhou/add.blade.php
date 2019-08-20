@extends('layout.admin')
@section('title','留言页面')
@section('body')
    <form action="{{url('zhou/do_add')}}" method="post" align="center">
        <input type="hidden" name="uid" value="{{$uid}}">
        @csrf
        留言：<textarea name="liya" id="" cols="30" rows="10"></textarea>
        <br/><br/>
        <input type="submit" value="提交">
    </form>
@endsection