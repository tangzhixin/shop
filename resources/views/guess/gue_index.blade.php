<h3 align="center">竞猜列表</h3>
<table border="1" align="center">
    <tr>
        <td>ID</td>
        <td>国家竞猜</td>
        <td>竞猜时间</td>
        <td>操作</td>
    </tr>
    @foreach($obj as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->name}}VS{{$v->cname}}</td>
            <td>
                {{date('Y-m-d H:i:s',$v->end_time)}}
            </td>
            <td>
                @if(($v->qsfp)==0)
                    @if(($v->end_time)>=time())
                        <a href="{{url('guess/gues',['id'=>$v->id])}}">竞猜</a>
                    @else
                        <a href="">竞猜结果</a>
                    @endif
                @elseif(($v->qsfp)!==0)
                    <a href="{{url('guess/result',['id'=>$v->id])}}">竞猜结果</a>
                @endif
            </td>
        </tr>
    @endforeach

</table>