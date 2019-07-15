<link rel="stylesheet" href="/css/page.css">
<form action="{{url('comm/index')}}" medhod="get" align="center">
    @csrf
    商品名称:<input type="text" name="search" value="">
    <input type="submit" value="搜索">
</form>
    <table border="1" align="center">
        <tr>
            <th>ID</th>
            <th>商品名称</th>
            <th>商品图片</th>
            <th>商品库存</th>
            <th>加入时间</th>
            <th>操作</th>
        </tr>
        @foreach($info as $v)
        <tr>
            <td>{{$v->b_id}}</td>
            <td>{{$v->b_name}}</td>
            <td>
                <img src="{{$v->b_pic}}" alt="" width="50" height="80">
            </td>
            <td>{{$v->b_repertory}}</td>
            <td>{{date('Y-m-d h:i:s',$v->add_time)}}</td>
            <td>
                <a href="/comm/del?b_id={{$v->b_id}}">删除</a>|
                <a href="/comm/update?b_id={{$v->b_id}}">修改</a>
            </td>
        </tr>
            @endforeach
    </table>
<center>
    {{ $info->appends(['search'=>$search])->links()}}
</center>

