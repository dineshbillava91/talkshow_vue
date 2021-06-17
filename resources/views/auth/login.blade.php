@extends ('homelayout')

<style>
.invalid-feedback
{
	display: block !important;
}
</style>

@section ('content')

	<div class="limiter" id="app">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="col-md-12 project-title">
					Talkshow
				</div>

				<div class="col-md-12" style="display: contents;">
					<div class="login100-pic js-tilt" data-tilt>
						<img src="images/img-01.png" alt="IMG">
					</div>

					<form class="login100-form" method="POST" action="{{ route('login') }}">
						@csrf
						<span class="login100-form-title">
							{{ __('Login') }}
						</span>

						<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
							<input class="input100" type="text" name="email" placeholder="Email" value="{{ old('email') }}">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</span>

							@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<div class="wrap-input100 validate-input" data-validate = "Password is required">
							<input class="input100" type="password" name="password" placeholder="Password" value="{{ old('password') }}">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-lock" aria-hidden="true"></i>
							</span>

							@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<div class="container-login100-form-btn">
							<button class="login100-form-btn">
								{{ __('Login') }}
							</button>
						</div>

						<div class="text-center p-t-12">
							@if (Route::has('password.request'))
								<a class="btn btn-link" href="{{ route('password.request') }}">
									{{ __('Forgot Your Password?') }}
								</a>
							@endif
						</div>

						<div class="text-center p-t-90">
							<a class="txt3" href="{{ route('register') }}">
								Not a Member? Register
								<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
							</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

@endsection