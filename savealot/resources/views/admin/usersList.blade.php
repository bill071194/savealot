@extends('layouts.baseAdmin')

@section('title', 'Users')
@section('adminTitle', 'Users')
@section('activeUsersList', 'active')

@section('section')

<div class="row">
	<div class="col-12 my-3">
		<div class="card h-100 shadow border-dark">
			<div class="card-body py-0 px-0 px-sm-3">
				{{$users->links()}}
				<table class="table table-light table-striped table-bordered border-dark-subtle table-hover m-0">
					<thead>
						<tr class="table-dark align-middle text-center">
							<th class="px-0"><span class="d-none d-xl-inline">User</span> ID</th>
							<th class="px-0">Name</th>
							<th class="px-0">Email</th>
							<th class="px-0">S<span class="d-none d-sm-inline">tudent</span><span class="d-none d-xl-inline"> Status</span></th>
							<th class="d-none d-sm-table-cell px-0"><span class="d-sm-none">Date</span><span class="d-none d-sm-inline">Created</span><span class="d-none d-lg-inline"> at</span></th>
						</tr>
					</thead>
					<tbody class="table-group-divider">
						@foreach ($users as $user)
						<tr class="align-middle text-center @if($user->student) table-info border-dark-subtle @endif">
							<td class="px-0">{{$user->id}}</td>
							<td class="text-break px-0">{{$user->name}}</td>
							<td class="text-break px-0 ">{{$user->email}}</td>
                            <td class="d-table-cell d-sm-none">@if($user->student) 1 @endif</td>
							<td class="d-none d-sm-table-cell px-0">@if($user->student) student @endif</td>
							<td class="d-none d-sm-table-cell d-md-none px-0">{{date_format($user->created_at, "M d")}}</td>
							<td class="d-none d-md-table-cell px-0">{{$user->date}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				{{$users->links()}}
			</div>
		</div>
	</div>
</div>

<div class="row">
    @foreach ($users as $user)
    <div class="col-12 col-md-6 col-xxl-4 my-3" id="id-{{$user->id}}">
        <div class="card h-100 shadow border-dark rounded-4" id="id-{{$user->id}}">
            <div class="card-header text-center rounded-top-4 h4 @if ($user->student == 1) text-bg-info @endif">{{$user->name}}</div>
            <div class="card-body">
                <form class="row" action="user/{{$user->id}}" method="post">
                    @csrf @method('PUT')
                    <div class="mb-1 mb-sm-3 col-8">
                        <label for="name">Name</label>
                        <div class="input-group rounded-3">
                            <input id="name-{{$user->id}}" type="text" class="form-control" name="name" min="0" max="1" value="{{old("name-$user->id",$user->name)}}" @if($user->id == 4) disabled readonly @endif>
                        </div>
                    </div>
                    <div class="mb-1 mb-sm-3 col-4">
                        <label for="id">ID</label>
                        <div class="input-group rounded-3">
                            <input id="id-{{$user->id}}" type="number" class="form-control" name="id" min="0" max="1" value="{{old("id-$user->id",$user->id)}}" disabled readonly>
                        </div>
                    </div>
                    <div class="mb-1 mb-sm-3 col-12">
                        <label for="email">Email</label>
                        <div class="input-group rounded-3">
                            <input id="email-{{$user->id}}" type="email" class="form-control" name="email" value="{{old("email-$user->id",$user->email)}}" @if($user->id == 4) disabled readonly @endif>
                        </div>
                    </div>
                    <div class="mb-1 mb-sm-3 col-8">
                        <label for="password">Password</label>
                        <div class="input-group rounded-3">
                            <input id="password-{{$user->id}}" type="password" class="form-control" name="password" value="" @if($user->id == 4) disabled readonly @endif>
                        </div>
                    </div>
                    <div class="mb-1 mb-sm-3 col-4">
                        <label for="student">Student</label>
                        <div class="input-group rounded-3">
                            <input id="student-{{$user->id}}" type="number" class="form-control" name="student" min="0" max="1" value="{{old("student-$user->id",$user->student)}}" @if($user->id == 4) disabled readonly @endif>
                        </div>
                    </div>
                    <div class="mb-1 mb-sm-3 col-6">
                        <label for="created_at-{{$user->id}}">Created at</label>
                        <div class="input-group rounded-3">
                            <input id="created_at-{{$user->id}}" type="text" class="form-control" name="student-{{$user->id}}" min="0" max="1" value="{{old("created_at-$user->id",$user->created_at)}}" disabled readonly>
                        </div>
                    </div>
                    <div class="mb-1 mb-sm-3 col-6">
                        <label for="updated_at-{{$user->id}}">Updated at</label>
                        <div class="input-group rounded-3">
                            <input id="updated_at-{{$user->id}}" type="text" class="form-control" name="student-{{$user->id}}" min="0" max="1" value="{{old("updated_at-$user->id",$user->updated_at)}}" disabled readonly>
                        </div>
                    </div>
                    @if($user->id == 4)
                    <input type="hidden" name="submit-{{$user->id}}" id="submit-{{$user->id}}" class="btn btn-primary rounded-5 px-3" value="Update" hidden disabled>
                    @else
                    <input type="submit" name="submit-{{$user->id}}" id="submit-{{$user->id}}" class="btn btn-primary rounded-5 px-3" value="Update" hidden>
                    @endif
                </form>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-evenly">
                    @if($user->id == 4)
                    <button class="btn btn-sm btn-danger rounded-5 px-3" type="button" data-bs-toggle="modal" data-bs-target="#{{$user->id}}-Modal" disabled>Delete</button>
                    <button class="btn btn-primary rounded-5 px-3" type="button" disabled>Update</button>
                    @else
                    <button class="btn btn-sm btn-danger rounded-5 px-3" type="button" data-bs-toggle="modal" data-bs-target="#{{$user->id}}-Modal">Delete</button>
                    <label for="submit-{{$user->id}}" class="btn btn-primary rounded-5 px-3">Update</label>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if($user->id == 4)
    @else
    <div class="modal fade" id="{{$user->id}}-Modal" tabindex="-1" aria-labelledby="{{$user->id}}ModelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="{{$user->id}}ModelLabel">Are you sure you want to delete this user?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Seriously their account will be gone!</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-5 px-3" data-bs-dismiss="modal">No go back!</button>
                    <form action="user/{{$user->id}}" method="post">
                        @csrf @method('DELETE')
                        <input type="email" name="email" value="deleted{{$user->id}}@localhost" hidden>
                        <input type="submit" class="btn btn-danger rounded-5 px-3" value="Delete User">
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach
    {{$users->links()}}
</div>

@endsection
