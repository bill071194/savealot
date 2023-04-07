@extends('layouts.baseAdmin')

@section('title', 'Users')
@section('adminTitle', 'Users')
@section('activeUsers', 'active')

@section('section')
<div class="mb-4 border-bottom">
    <div class="btn-group w-100 justify-content-center">
        <form class="" action="" method="get">
            <input type="hidden" name="dashboardDates" value="last7d">
            <input type="submit" class="btn rounded-end-0 @if (session('dashboardDates') == 'last7d') btn-primary @else btn-outline-primary @endif" value="Last 7 days">
        </form>
        <form class="" action="" method="get">
            <input type="hidden" name="dashboardDates" value="last30d">
            <input type="submit" class="btn rounded-0 @if (session('dashboardDates') == 'last30d') btn-primary @else btn-outline-primary @endif" value="Last 30 days">
        </form>
        <form class="" action="" method="get">
            <input type="hidden" name="dashboardDates" value="last12m">
            <input type="submit" class="btn rounded-0 @if (session('dashboardDates') == 'last12m') btn-primary @else btn-outline-primary @endif" value="Last 12 months">
        </form>
        <form class="" action="" method="get">
            <input type="hidden" name="dashboardDates" value="last5y">
            <input type="submit" class="btn rounded-start-0 @if (session('dashboardDates') == 'last5y') btn-primary @else btn-outline-primary @endif" value="Last 5 years">
        </form>
    </div>
    <div class="text-center w-100 fw-bold my-2">New Users</div>
    <canvas class="my-2 w-100" id="usersChart" width="1430" height="603" style="display: block; box-sizing: border-box; height: 301px; width: 715px;"></canvas>
</div>

<div class="row">
    <table class="table table-light table-striped table-bordered border-dark-subtle table-hover">
        <thead>
            <tr class="table-dark">
                <th>Date</th>
                <th>New Users</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach (array_reverse($usersGrouped) as $userGroup)
            <tr>
                <td>{{$userGroup['date']}}</td>
                <td>{{$userGroup['count']}}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="table-success">
                <th>
                    @switch(session('dashboardDates'))
                        @case('last5y')
                            5 year total
                            @break
                        @case('last12m')
                        12 month total
                            @break
                        @case('last30d')
                        30 day total
                            @break
                        @case('last7d')
                        7 day total
                            @break
                        @default
                            30 day total
                            @break
                    @endswitch
                </th>
                @php($total = 0)
                @foreach ($usersGrouped as $userGroup)
                    @php($total += $userGroup['count'])
                @endforeach
                <th>{{$total}}</th>
            </tr>
        </tfoot>
    </table>
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
</div>

<script>
	const usersChart = new Chart(document.getElementById('usersChart'), {
		type: 'line',
		data: {
			labels: [@foreach ($usersGrouped as $userGroup) "{{$userGroup['date']}}", @endforeach],
			datasets: [{
				data: [@foreach ($usersGrouped as $userGroup) {{$userGroup['count']}}, @endforeach],
				lineTension: 0.25,
				backgroundColor: 'green',
				borderColor: 'green',
				borderWidth: 4,
				pointBackgroundColor: 'yellow'
			}]
		},
		options: {
			plugins: {
				legend: {
					display: false
				},
				tooltip: {
					boxPadding: 3
				}
			}
		}
	});
</script>

@endsection
