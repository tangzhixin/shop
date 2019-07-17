@extends('layout.admin')
@section('body')
    <table class="layui-table">
        <colgroup>
            <col width="150">
            <col width="200">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th>ID</th>
            <th>用户名</th>
            <th>添加时间</th>
            <th>权限</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $v)
        <tr id="{{$v->id}}" field="state">
            <td>{{$v->id}}</td>
            <td>{{$v->name}}</td>
            <td>
                {{date('Y-m-d H:i:s',$v->reg_time)}}
            </td>
            <td>
                @if($v->state==2)
                    管理员
                @else($v->state==3)
                    该用户被列入黑名单
                @endif
            </td>
            <td>
                @if($v->state==2)
                <button class="yiku" value="1">晋升为root</button>
                <button class="yiku" value="3">拉人黑名单</button>
                @else
                <button class="yiku" value="1">晋升为root</button>
                <button class="yiku" value="2">晋升为管理员</button>
                @endif
            </td>
        </tr>
        @endforeach
        <tr>
            <h2 align="center">{{$data->links()}}</h2>
        </tr>
        </tbody>
    </table>
@endsection
<script src="/jquery.js"></script>
<script>
    $(function () {
        $('.yiku').click(function () {
            var obj=$(this);
            var text=obj.text();
            var session={{Session::get('state')}};
            if(session!=1){
                alert('对不起,你没有相关权限');return false;
            }
            var value=obj.attr('value');
            var field=obj.parents('tr').attr('field');
            var id=obj.parents('tr').attr('id');
            $.get(
                "{{url('AdminController/state')}}",
                {id:id,value:value,field:field},
                function (res) {
                    if(res.code==1){
                        if (value==2){
                            obj.attr('value','3');
                            obj.text('拉入黑名单');
                            obj.parents('td').prev('td').text('管理员');
                        } else if(value==3){
                            obj.attr('value','2');
                            obj.text('晋升为管理员');
                            obj.parents('td').prev('td').text('该用户被列为黑名单');
                        }else{
                            obj.parents('tr').remove();
                        }
                    }
                },'json'

            );
        });
    });
</script>