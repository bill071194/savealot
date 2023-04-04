@extends('layouts.baseAdmin')

@section('title', 'Users')
@section('adminTitle', 'Users')
@section('activeUsers', 'active')

@section('section')
<table class="table table-light table-striped table-bordered border-dark-subtle table-hover m-0">
    <thead>
        <tr class="table-dark">
            <th><span class="d-none d-xl-inline">User</span> ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Student <span class="d-none d-xl-inline">Status</span></th>
            <th>Created <span class="d-none d-lg-inline">at</span></th>
            <th>Updated <span class="d-none d-lg-inline">at</span></th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->student}}</td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->updated_at}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
