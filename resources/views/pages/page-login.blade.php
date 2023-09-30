@extends('layout.empty')

@section('title', 'Login')

@section('content')
  <!-- BEGIN login -->
	<div class="login">
		<!-- BEGIN login-content -->
		<div class="login-content">
			<form action="{{ url('dologin')}}" method="POST" name="login_form">
				@csrf
				<h1 class="text-center">Sign In</h1>
				<div class="text-muted text-center mb-4">
					Please input your order id to login
				</div>
				<div class="mb-3">
					<div class="d-flex">
						<label class="form-label">Order ID</label>
					</div>
					<input type="text" class="form-control form-control-lg fs-15px" name="order_id" value="" placeholder="Enter your order id">
				</div>
				<button type="submit" class="btn btn-theme btn-lg d-block w-100 fw-500 mb-3">Sign In</button>
			</form>
		</div>
		<!-- END login-content -->
	</div>
	<!-- END login -->
@endsection
