<h3 align="center">竞猜列表</h3>
<table border="1" align="center">
    <tr>
        <td>ID</td>
        <td>国家竞猜</td>
        <td>竞猜结果</td>
        <td>竞猜时间</td>
    </tr>
    @foreach($obj as $v)
      <tr>
          <td>{{$v->id}}</td>
          <td>{{$v->name}}VS{{$v->cname}}</td>
          <td>
              {{$v->name}}
              @if(($v->sfp)==1)
              胜
              @elseif(($v->sfp)==2)
              平
              @elseif(($v->sfp)==3)
              负
              @endif
              {{$v->cname}}</td>
          <td>
              {{date('Y-m-d H:i:s',$v->end_time)}}
          </td>

      </tr>
    @endforeach

</table>