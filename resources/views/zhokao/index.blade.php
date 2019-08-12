@extends('layout.admin')
@section('title','列表')
@section('body')
    <center>
        <h2><a href="{{url('Studen/add')}}" class="layui-btn">添加</a></h2>
    </center>
    <link rel="stylesheet" href="/css/page.css">
    <form action="{{url('Studen/index')}}" medhod="get" align="center">
        @csrf
        出发地:<input type="text" name="place" value="{{$place}}">
        到达地:<input type="text" name="arrival" value="{{$arrival}}">
        <input type="submit" class="layui-btn layui-btn-radius layui-btn-normal" value="搜索">
    </form>
    <table border="1" align="center">
        <tr>
            <th>车次</th>
            <th>出发地</th>
            <th>到达地</th>
            <th>价钱</th>
            <th>张数</th>
            <th>出发时间</th>
            <th>到达时间</th>
            <th>操作</th>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->train}}</td>
            <td>{{$v->place}}</td>
            <td>{{$v->arrival}}</td>
            <td>{{$v->price}}</td>
            <td>
                @if($v->sheets>=100)
                有
                @elseif($v->sheets<=0)
                无
                @else
                 {{$v->sheets}}
                @endif
            </td>
            <td>{{date('Y-m-d H:i:s',$v->place_time)}}</td>
            <td>{{date('Y-m-d H:i:s',$v->arrival_time)}}</td>
            <td>
                @if($v->sheets<=0)
                没有票
                @else
                <a href="">预约</a>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
    <center>
        {{ $data->appends(['place'=>$place,'arrival'=>$arrival])->links()}}
    </center>
@endsection    