
    <form class="layui-form" action="{{url('comm/do_insert')}}" method="post" enctype="multipart/form-data">
        @csrf
        <table border="1">
            <tr>
                <td>商品名称</td>
                <td>
                    <input type="text" name="b_name">
                </td>
            </tr>
            <tr>
                <td>商品图片</td>
                <td>
                    <input type="file" name="b_pic" id="">
                </td>
            </tr>
            <tr>
                <td>商品库存</td>
                <td>
                    <input type="text" name="b_repertory" id="">
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="立即提交"></td>
            </tr>
        </table>

    </form>

