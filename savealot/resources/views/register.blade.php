@extends('layouts.base')

@section('title', 'Register')
@section('activeRegister', 'active')

@section('main')
<div class="modal modal-signin position-static d-block" style="z-index: 955;" tabindex="-1" role="dialog" id="modalSignin">
	<div class="modal-dialog" role="document">
		<div class="modal-content rounded-4 shadow">
			<div class="modal-header p-5 pb-4 border-bottom-0">
				<h1 class="fw-bold mb-0 fs-2">Register</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body p-5 pt-0">
				<form class="">
					<div class="form-floating mb-3">
					<input type="email" class="form-control rounded-3" id="floatingInput" placeholder="name@example.com">
					<label for="floatingInput">Email</label>
					</div>
					<div class="form-floating mb-3">
					<input type="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password">
					<label for="floatingPassword">Password</label>
					</div>
					<button class="w-100 btn btn-lg rounded-3 btn-success" type="submit">Register</button>
				</form>
					<hr class="my-4">
					<p class="text-muted text-center">Already have an account? Login here</p>
					<div class="d-flex justify-content-center">
						<a class="mb-2 btn btn rounded-3 btn-dark" href="login.html">Login</a>
					</div>
			</div>
		</div>
	</div>
</div>
@endsection