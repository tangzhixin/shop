@extends('layout.common')
@section('title','登录')
@section('pages section')
<div class="pages section">
		<div class="container">
			<div class="pages-head">
				<h3>登录</h3>
			</div>
			<div class="login">
				<div class="row">
					<form class="col s12" action="{{url('student/do_login')}}" method="post">
                    @csrf
						<div class="input-field">
							<input type="text" class="validate" name="name" placeholder="USERNAME" required>
						</div>
						<div class="input-field">
							<input type="password" class="validate" name="pwd" placeholder="PASSWORD" required>
						</div>
						<a href=""><h6>Forgot Password ?</h6></a>
						 <input type="submit" class="btn button-default" value="LOGIN">
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection