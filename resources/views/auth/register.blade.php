@extends ('homelayout')

<style>
.select100 {
	font-family: Poppins-Medium;
	font-size: 15px;
	line-height: 1.5;
	color: #666;
	display: block;
	width: 100%;
	background: #e6e6e6;
	height: 50px;
	border-radius: 25px;
	padding: 0 30px 0 68px
}
.focus-select100 {
	display: block;
	position: absolute;
	border-radius: 25px;
	bottom: 0;
	left: 0;
	z-index: -1;
	width: 100%;
	height: 100%;
	box-shadow: 0 0;
	color: rgba(87, 184, 70, .8)
}
.select100:focus+.focus-select100 {
	-webkit-animation: anim-shadow .5s ease-in-out forwards;
	animation: anim-shadow .5s ease-in-out forwards
}
</style>

@section ('content')

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="col-md-12 project-title">
					Talkshow
				</div>

				<div class="col-md-12" style="display: contents;">
					<div class="login100-pic js-tilt" data-tilt>
						<img src="images/img-01.png" alt="IMG">
					</div>

					<form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
						@csrf
						<span class="login100-form-title">
							{{ __('Register') }}
						</span>

						<div class="wrap-input100 validate-input" data-validate = "Valid name is required">
							<input id="name" type="text" class="input100" name="name" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
							
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-user" aria-hidden="true"></i>
							</span>

							@error('name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

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

						<div class="wrap-input100 validate-input" data-validate = "Confirm Password is required">
							<input class="input100" type="password" name="password_confirmation" placeholder="Confirm Password" value="{{ old('password_confirmation') }}">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-lock" aria-hidden="true"></i>
							</span>

							@error('password_confirmation')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>

						<div class="wrap-input100 validate-input">
							<select class="select100" name="role_id" id="roles" placeholder="Role">
								<option value="">Select Role</option>
								@foreach($roles as $role)
									<option value="{{ $role->id }}" {{ (old('role_id') == $role->id) ? 'selected':'' }}>{{ $role->name }}</option>
								@endforeach
							</select>
							<span class="focus-input100"></span>

							@error('role_id')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
                        </div>

						<div class="container-login100-form-btn">
							<button class="login100-form-btn">
								{{ __('Register') }}
							</button>
						</div>

						<div class="text-center p-t-12">
							<span class="txt1">
								Forgot
							</span>
							<a class="txt2" href="{{ route('password.request') }}">
								Username / Password?
							</a>
						</div>

						<div class="text-center p-t-50">
							<a class="txt3" href="{{ route('login') }}">
								Already a Member? Login
								<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
							</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

@endsection