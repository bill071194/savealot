@extends('layouts.baseAdmin')

@section('title', 'Users')
@section('adminTitle', 'Users')
@section('activeUsers', 'active')

@section('section')
<div class="mb-4 border-bottom row">
    <div class="btn-group w-100 px-2 px-sm-3 justify-content-center">
        <form class="" action="" method="get">
            <input type="hidden" name="dashboardDates" value="last7d">
            <input type="submit" id="last7d-sumbit" name="last7d-sumbit" hidden>
        </form>
        <form class="" action="" method="get">
            <input type="hidden" name="dashboardDates" value="last30d">
            <input type="submit" id="last30d-sumbit" name="last30d-sumbit" hidden>
        </form>
        <form class="" action="" method="get">
            <input type="hidden" name="dashboardDates" value="last12m">
            <input type="submit" id="last12m-sumbit" name="last12m-sumbit" hidden>
        </form>
        <form class="" action="" method="get">
            <input type="hidden" name="dashboardDates" value="last5y">
            <input type="submit" id="last5y-sumbit" name="last5y-sumbit" hidden>
        </form>
        <label for="last7d-sumbit" class="btn rounded-start-3 px-1 px-sm-2 @if (session('dashboardDates') == 'last7d') btn-primary @else btn-outline-primary @endif"><span class="d-none d-sm-inline">Last </span>7 days</label>
        <label for="last30d-sumbit" class="btn rounded-0 px-1 px-sm-2 @if (session('dashboardDates') == 'last30d') btn-primary @else btn-outline-primary @endif"><span class="d-none d-sm-inline">Last </span>30 days</label>
        <label for="last12m-sumbit" class="btn rounded-0 px-1 px-sm-2 @if (session('dashboardDates') == 'last12m') btn-primary @else btn-outline-primary @endif"><span class="d-none d-sm-inline">Last </span>12 months</label>
        <label for="last5y-sumbit" class="btn rounded-end-3 px-1 px-sm-2 @if (session('dashboardDates') == 'last5y') btn-primary @else btn-outline-primary @endif"><span class="d-none d-sm-inline">Last </span>5 years</label>
    </div>
    <div class="col-12 border-bottom">
        <div class="text-center w-100 fw-bold mt-2">New Users Chart</div>
        <canvas class="mb-2 w-100" id="usersChart" width="3000" height="1000" style="display: block; box-sizing: border-box; height: 301px; width: 715px;"></canvas>
    </div>
</div>

<div class="row">
    <table class="table table-light table-striped table-bordered border-dark-subtle table-hover">
        <thead class="table-dark">
            <tr>
                <th>Date</th>
                <th>Accounts Created</th>
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
            <tr class="table-info">
                <th>
                    @switch(session('dashboardDates'))
                        @case('last5y') 5 year total @break
                        @case('last30d') 30 day total @break
                        @case('last7d') 7 day total @break
                        @default 12 month total @break
                    @endswitch
                </th>
                @php($totalCount = 0)
                @foreach ($usersGrouped as $userGroup)
                    @php($totalCount += $userGroup['count'])
                @endforeach
                <th>{{$totalCount}}</th>
            </tr>
        </tfoot>
    </table>
</div>


<script>
    new Chart(document.getElementById('usersChart'), {
		type: 'line',
		data: {
			labels: [@foreach ($usersGrouped as $userGroup) "{{$userGroup['date']}}", @endforeach],
			datasets: [{
				data: [@foreach ($usersGrouped as $userGroup) {{$userGroup['count']}}, @endforeach],
				lineTension: 0.25,
				backgroundColor: '#0dcaf099',
				borderColor: '#0009',
				borderWidth: 4,
                fill: true,
			}]
		},
		options: {
            scales: {
                y: {
                    beginAtZero: true,
                }
            },
			plugins: {
				legend: {
					display: false,
				},
				tooltip: {
					boxPadding: 3,
				}
			}
		}
	});
</script>

@endsection
