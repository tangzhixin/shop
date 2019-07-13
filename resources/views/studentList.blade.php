<center>
    <h1>学生列表</h1>
    <h2><a href="{{url('student/add')}}">添加</a></h2>
</center>
<link rel="stylesheet" href="/css/page.css">

<form action="{{url('student/index')}}" medhod="get" align="center">
    @csrf
    名字:<input type="text" name="search" value="{{$search}}">
    <input type="submit" value="搜索">
</form>
<table border='1' align="center">
    <tr>
        <th>ID</th>
        <th>名字</th>
        <th>年龄</th>
        <th>性别</th>
        <td>添加时间</td>
        <th>操作</th>
    </tr>
    @foreach($student as $v)
    <tr>
        <td>{{ $v->id }}</td>
        <td>{{ $v->name }}</td>
        <td>{{ $v->age }}</td>
        <td>
            @if($v->ext==0)
            男
            @else
            女
            @endif
        </td>
        <td>{{date('Y-m-d h:i:s',$v->add_time)}}</td>
        <td>
            <a href="/student/delete?id={{$v->id}}">删除</a>|
            <a href="/student/update?id={{$v->id}}">修改</a>
        </td>
        
    </tr>
    @endforeach
</table>
<center>
    {{ $student->appends(['search'=>$search])->links()}}
</center>




