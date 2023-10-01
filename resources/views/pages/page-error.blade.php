@extends('layout.empty')

@section('title', 'Error Page')

@section('content')
        <!-- BEGIN error -->
		<div class="error-page">
			<!-- BEGIN error-page-content -->
			<div class="error-page-content">
				<div class="error-img">
					<img src="/assets/img/page/pos-error.svg" alt="">
				</div>
				
				<h1>Oops!</h1> 
				<h3>We can't seem to log you in</h3>
				<a href="/" class="btn btn-theme">Go to Homepage</a>
			</div>
			<!-- END error-page-content -->
		</div>
		<!-- END error -->
@endsection
