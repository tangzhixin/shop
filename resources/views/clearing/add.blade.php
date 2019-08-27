
    <form action="{{url('clearing/do_add')}}" method="post" align="center">
        @csrf
        <input type="hidden" name="openid" value="{{$openid}}">
        粉丝名称：<input type="text" name="nickname" value="{{$nickname}}" id="">
        <br/><br/>
        是否匿名：<input type="radio" name="status" value="匿名用户">是
                  <input type="radio" name="status" value="{{$nickname}}">否
        <br/><br/>
        表白内容：<textarea name="title" id="" cols="30" rows="10"></textarea>
        <br/><br/>
        <input type="submit" value="表白">
    </form>
