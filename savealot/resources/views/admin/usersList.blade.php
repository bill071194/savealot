@extends('layouts.baseAdmin')

@section('title', 'Users')
@section('adminTitle', 'Users')
@section('activeUsersList', 'active')

@section('section')

<div class="row">
    <div class="col-12 my-3">
        <div class="card h-100 shadow border-dark">
            <div class="card-body py-0">
                {{$users->links()}}
                <table class="table table-light table-striped table-bordered border-dark-subtle table-hover m-0">
                    <thead>
                        <tr class="table-dark">
                            <th><span class="d-none d-xl-inline">User</span> ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Student <span class="d-none d-xl-inline">Status</span></th>
                            <th>Created <span class="d-none d-lg-inline">at</span></th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($users as $user)
                        <tr class="@if($user->student) table-info border-dark-subtle @endif">
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>@if($user->student) student @endif</td>
                            <td class="d-sm-none">{{date_format($user->created_at, "M d")}}</td>
                            <td class="d-none d-sm-table-cell">{{$user->date}}</td>
                            <td>
                                <button class="btn btn-sm btn-danger rounded-5 px-3" type="button" data-bs-toggle="modal" data-bs-target="#{{$user->id}}-Modal">Delete</button>
                                <div class="modal fade" id="{{$user->id}}-Modal" tabindex="-1" aria-labelledby="{{$user->id}}ModelLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="{{$user->id}}ModelLabel">Are you sure you want to delete this item?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h6>Seriously it'll be gone!</h6>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary rounded-5 px-3" data-bs-dismiss="modal">No go back!</button>
                                                <form action="usersList/{{$user->id}}/delete" method="post">
                                                    @csrf
                                                <input type="submit" class="btn btn-danger rounded-5 px-3" value="Delete">
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$users->links()}}
            </div>

        </div>
    </div>
</div>

@endsection
