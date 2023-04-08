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
