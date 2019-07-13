@extends('layout.common')
@section('title','注册')
@section('pages section')
<div class="pages section">
		<div class="container">
			<div class="pages-head">
				<h3>REGISTER</h3>
			</div>
			<div class="register">
				<div class="row">
					<form class="col s12" action="{{url('student/do_register')}}" method="post">
							@csrf
						<div class="input-field">
							<input type="text" class="validate" name="name" placeholder="NAME" required>
						</div>
						<div class="input-field">
							<input type="email" placeholder="EMAIL" name="email" class="validate" required>
						</div>
						<div class="input-field">
							<input type="password" placeholder="PASSWORD" name="pwd" class="validate" required>
						</div>
						 <input type="submit" class="btn button-default" value="REGISTER">
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection