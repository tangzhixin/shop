@extends('layout.common')
@section('title','订单列表')
@section('pages section')
    <table>
        <tr>
            <th>订单号</th>
            <th>状态</th>
            <th>价钱</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        @foreach($obj as $v)
        <tr>
            <td>{{$v->oid}}</td>
            <td>
                @if($v->state==1)
                 未支付
                @elseif($v->state==2)
                 已支付
                @elseif($v->state==3)
                 已过期
                @endif
            </td>
            <td>{{$v->pay_money}}</td>
            <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
            <td>
                <a href="">去支付</a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection