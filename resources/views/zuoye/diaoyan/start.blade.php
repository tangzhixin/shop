<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<script type="text/javascript" src="/jquery.js"></script>
</head>
<body>
	@foreach($data as $v)
	@if($v->type==1)
		<div class="div">
			<b>问:{{$v->question}}</b><p>
			A:<input type="radio" name="radio">{{$v->a}}<p>
			B:<input type="radio" name="radio">{{$v->b}}<p>
			C:<input type="radio" name="radio">{{$v->c}}<p>
			D:<input type="radio" name="radio">{{$v->d}}<p>
			<button class="aa">确认</button>
		</div>
	@else
		<div class="div">
			<b>问:{{$v->question}}</b><p>
			A:<input type="checkbox" name="checkbox">{{$v->a}}<p>
			B:<input type="checkbox" name="checkbox">{{$v->b}}<p>
			C:<input type="checkbox" name="checkbox">{{$v->c}}<p>
			D:<input type="checkbox" name="checkbox">{{$v->d}}<p>
			<button class="aa">确认</button>
		</div>
	@endif
	@endforeach
</body>
</html>
<script type="text/javascript">
	$('.div:gt(0)').hide();
	$('.aa').click(function(){
		var _this = $(this);
		_this.parents('div').hide();
		_this.parents('div').next('div').show();
	});
	
</script>