
<form class="layui-form" action="{{url('comm/do_update')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="b_id" value="{{$obj->b_id}}">
    <table border="1">
        <tr>
            <td>商品名称</td>
            <td>
                <input type="text" name="b_name" value="{{$obj->b_name}}">
            </td>
        </tr>
        <tr>
            <td>商品图片</td>
            <td>
                <input type="file" name="b_pic" value="{{$obj->b_pic}}" id="">
                <img src="{{$obj->b_pic}}" alt="" width="50" height="60">
            </td>
        </tr>
        <tr>
            <td>商品库存</td>
            <td>
                <input type="text" name="b_repertory" value="{{$obj->b_repertory}}" id="">
            </td>
        </tr>
        <tr>
            <td><input type="submit" value="立即修改"></td>
        </tr>
    </table>

</form>

