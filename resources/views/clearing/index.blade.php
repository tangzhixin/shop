@extends('layout.admin')
@section('title','表白列表页面')
@section('body')
    <h2 align="center"><a href="{{url('clearing/add')}}">我要表白</a></h2>
    <br/><br/>
    <h2 align="center"><a href="{{url('clearing/list')}}">我的表白</a></h2>
@endsection