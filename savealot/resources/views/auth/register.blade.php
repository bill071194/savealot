@extends('layouts.base')
@section('title', 'Register')
@section('activeRegister', 'active')
@section('main')
<div class="modal modal-signin position-static d-block" style="z-index: 955;" tabindex="-1" role="dialog" id="modalSignin">
	<div class="modal-dialog" role="document">
		<div class="modal-content rounded-4 shadow">
			<div class="modal-header p-5 pb-4 border-bottom-0">
				<h1 class="fw-bold mb-0 fs-2" id="login_h1">Register</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body p-5 pt-0">
				<form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-floating mb-3">
					    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="FirstName LastName">
					    @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					    <label for="name">Full Name</label>
					</div>
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
					    <input id="student" type="hidden" class="form-control rounded-3 @error('email') is-invalid @enderror" name="student" value="0" autofocus placeholder="name@example.com">
					    @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
					<div class="form-floating mb-3">
					    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Password">
					    <label for="password-confirm">Confirm Password</label>
					</div>

					<button class="w-100 btn btn-lg rounded-5 px-3 btn-success" type="submit">Register</button>
				</form>
					<hr class="my-4">
					<p class="text-muted text-center">Already have an account? Log in here</p>
					<div class="d-flex justify-content-center">
						<a class="mb-2 btn rounded-5 px-3 btn-dark" href="/login">Log in</a>
					</div>
			</div>
		</div>
	</div>
</div>

@endsection
