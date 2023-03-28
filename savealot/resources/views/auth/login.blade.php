@extends('layouts.base')

@section('title', 'Log in')

@section('activeLogin', 'active')

@section('main')
<div class="modal modal-signin position-static d-block" style="z-index: 955;" tabindex="-1" role="dialog" id="modalSignin">
	<div class="modal-dialog" role="document">
		<div class="modal-content rounded-4 shadow">
			<div class="modal-header p-5 pb-4 border-bottom-0">
				<h1 class="fw-bold mb-0 fs-2" id="login_h1">Log in</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body p-5 pt-0">
				<form method="POST" action="{{ route('login') }}">
                    @csrf
					<div class="form-floating mb-3">
					    <input id="email" type="email" class="form-control rounded-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="name@example.com">
					    @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					    <label for="email">Email</label>
					</div>
					<div class="form-floating mb-3">
					    <input input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
					    @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					    <label for="password">Password</label>
					</div>
					<div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
					<button class="w-100 btn btn-lg rounded-5 px-3 btn-success" type="submit">Log in</button>
				</form>
					<hr class="my-4">
					<p class="text-muted text-center">Don't have an account? Click to register</p>
					<div class="d-flex justify-content-center">
						<a class="mb-2 btn rounded-5 px-3 btn-dark" href="/register">Register</a>
					</div>
			</div>
		</div>
	</div>
</div>
@endsection
