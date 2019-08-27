
    <table align="center" border="1">
        <tr>
            <th>名称</th>
            <th>操作</th>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->nickname}}</td>
            <td>
                <a href="{{url('clearing/add',['openid'=>$v->openid])}}?nickname={{$v->nickname}}">表白</a>
            </td>
        </tr>
        @endforeach
    </table>
