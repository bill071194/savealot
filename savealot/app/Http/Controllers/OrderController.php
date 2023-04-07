<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use DB;

class OrderController extends Controller
{
    public function checkOut(Request $request) {
        $user_id = $request->user_id;
        $inventory = inventory::all();
        $subtotal = 0;
        $discount = 0;
        $total = 0;
        $dt = Carbon::now();
        $date = $dt->toDateString();

        foreach ($inventory as $item) {
            if (session($item->id) > 0) {
                $prod_name = $item->prod_name;
                $prod_picture = $item->prod_picture;
                $prod_price = $item->prod_selling_price;
                $item_qty = session($item->id);
                $item_total = $prod_price * $item_qty;
                $subtotal += $item_total;
            }
        }

        if ($request->student == 1) {
            $student = 1;
            $discount = number_format($subtotal * 0.1, 2, '.', '');
            $total = $subtotal - $discount;
        } else {
            $student = 0;
            $total = $subtotal;
        }

        $order = new Order();
        $order->user_id = $user_id;
        $order->subtotal = $subtotal;
        $order->total = $total;
        $order->discount = $discount;
        $order->student = $student;
        $order->date = $date;

        if ($order->save()) {
            // session('status') = 'Purchase Successful!';
            $row = Order::all()->sortBy('id')->last();
            $order_id = $row['id'];
            foreach ($inventory as $item) {
                if (session($item->id) > 0) {
                    $prod_name = $item->prod_name;
                    $prod_picture = $item->prod_picture;
                    $prod_price = $item->prod_selling_price;
                    $item_qty = session($item->id);
                    $item_total = $prod_price * $item_qty;
                    // Transaction
                    $transaction = new Transaction();
                    $transaction->user_id = $user_id;
                    $transaction->order_id = $order_id;
                    $transaction->prod_id = $item->id;
                    $transaction->prod_name = $prod_name;
                    $transaction->prod_picture = $prod_picture;
                    $transaction->prod_price = $prod_price;
                    $transaction->item_qty = $item_qty;
                    $transaction->item_total = $item_total;
                    $transaction->save();
                    session(["$item->id" => 0]);
                    // Inventory
                    $item->prod_quantity -= $item_qty;
                    $item->update();
                }
            }
            return redirect('/orderhistory');
        } else {
            return redirect('/cart');
        }
    }

    public function orderHistory() {
        $orders = Order::where('user_id', '=', auth()->id())->get()->sortByDesc('id');
        $transactions = Transaction::where('user_id', '=', auth()->id())->get();
        $inventory = Inventory::all();
        return view('orderhistory',['orders' => $orders, 'transactions' => $transactions, 'inventory' => $inventory]);
    }

    public function adminDashboard() {
        $orders = Order::all();
        $transactions = Transaction::all();
        $inventory = Inventory::paginate(12);
        $users = User::all();

        $backwards_date_array = array();
        $revenueData = array();
        $usersData = array();

        $i = 0;
        while ($i < 7) {
            $today = Carbon::today();
            array_push( $backwards_date_array, $today->subDays($i)->format('Y-m-d') );
            $i++;
        }

        $date_array = array_reverse($backwards_date_array);

        if(! empty( $date_array ) ){
            foreach($date_array as $date){
                $revenue = Order::where( 'date', '=', $date )->get()->sum('total');
                array_push($revenueData, $revenue);

                $user_count = User::where( 'date', '=', $date )->get()->count('id');
                array_push($usersData, $user_count);
            }
        }

        return view('admin',['orders' => $orders, 'transactions' => $transactions, 'inventory' => $inventory, 'users' => $users, 'revenueData' => $revenueData, 'usersData' => $usersData]);
    }

    public function allOrders() {
        $orders = Order::all();
        $transactions = Transaction::all();
        $inventory = Inventory::all();

        $backwards_date_array = array();
        $chartData = array();

        $i = 0;
        while ($i < 7) {
            $today = Carbon::today();
            array_push( $backwards_date_array, $today->subDays($i)->format('Y-m-d') );
            $i++;
        }

        $date_array = array_reverse($backwards_date_array);

        if(! empty( $date_array ) ){
            foreach($date_array as $date){
                $revenue = Order::where( 'date', '=', $date )->get()->sum('total');
                array_push($chartData, $revenue);
            }
        }

        return view('orders',['orders' => $orders, 'transactions' => $transactions, 'inventory' => $inventory, 'chartData' => $chartData]);
    }

    public function allUsers() {
        $users = User::all();

        $backwards_date_array = array();
        $chartData = array();

        $i = 0;
        while ($i < 7) {
            $today = Carbon::today();
            array_push( $backwards_date_array, $today->subDays($i)->format('Y-m-d') );
            $i++;
        }

        $date_array = array_reverse($backwards_date_array);

        if(! empty( $date_array ) ){
            foreach($date_array as $date){
                $user_count = User::where( 'date', '=', $date )->get()->count('id');
                array_push($chartData, $user_count);
            }
        }

        return view('users', ['users' => $users, 'chartData' => $chartData]);
    }

    public function UsersDashboard(Request $request) {
        session(['dashboardDates' => $request->dashboardDates]);
        $dates = session('dashboardDates');

        $users = User::selectRaw('*, DATE_FORMAT(created_at, "%Y") as year, DATE_FORMAT(created_at, "%Y-%m") as month, DATE_FORMAT(created_at, "%Y-%m-%d") as day')->get();
        $orders = Order::all();
        $transactions = Transaction::all();
        $inventory = Inventory::all();

        $today = Carbon::today();

        switch ($dates) {
            case 'last5y':
                $usersGrouped = array();
                for ($i=4; $i >= 0; $i--) {
                    $year = $today->subYears($i);
                    $u = $users->where('year', '=', $year->format("Y"));
                    $usersGrouped[$year->format("Y")] = array('date' => $year->format("Y"), 'count' => $u->count());
                    $year->addYears($i);
                }
                break;
            case 'last12m':
                $ordersGrouped = array();
                for ($i=11; $i >= 0; $i--) {
                    $month = $today->subMonths($i);
                    $u = $users->where('month', '=', $month->format("Y-m"));
                    $usersGrouped[$month->format("Y-m")] = array('date' => $month->format("F Y"), 'count' => $u->count());
                    $month->addMonths($i);
                }
                break;
            case 'last7d':
                $ordersGrouped = array();
                for ($i=6; $i >= 0; $i--) {
                    $day = $today->subDays($i);
                    $u = $users->where('date', '=', $day->format("Y-m-d"));
                    $usersGrouped[$day->format("Y-m-d")] = array('date' => $day->format("F d"), 'count' => $u->count());
                    $day->addDays($i);
                }
                break;
            case 'last30d': default:
                $ordersGrouped = array();
                for ($i=29; $i >= 0; $i--) {
                    $day = $today->subDays($i);
                    $u = $users->where('date', '=', $day->format("Y-m-d"));
                    $usersGrouped[$day->format("Y-m-d")] = array('date' => $day->format("F d"), 'count' => $u->count());
                    $day->addDays($i);
                }
                break;
        }

        return view('users',['orders' => $orders, 'transactions' => $transactions, 'inventory' => $inventory, 'users' => $users, 'usersGrouped' => $usersGrouped]);
    }

    public function OrdersDashboard(Request $request) {
        session(['dashboardDates' => $request->dashboardDates]);
        $dates = session('dashboardDates');

        $orders = Order::selectRaw('*, DATE_FORMAT(created_at, "%Y") as year, DATE_FORMAT(created_at, "%Y-%m") as month, DATE_FORMAT(created_at, "%Y-%m-%d") as day')->get();
        $today = Carbon::today();

        switch ($dates) {
            case 'last5y':
                $ordersGrouped = array();
                for ($i=4; $i >= 0; $i--) {
                    $year = $today->subYears($i);
                    $o = $orders->where('year', '=', $year->format("Y"));
                    $ordersGrouped[$year->format("Y")] = array('date' => $year->format("Y"), 'count' => $o->count(), 'revenue' => $o->sum('total'));
                    $year->addYears($i);
                }
                break;
            case 'last12m':
                $ordersGrouped = array();
                for ($i=11; $i >= 0; $i--) {
                    $month = $today->subMonths($i);
                    $o = $orders->where('month', '=', $month->format("Y-m"));
                    $ordersGrouped[$month->format("Y-m")] = array('date' => $month->format("F Y"), 'count' => $o->count(), 'revenue' => $o->sum('total'));
                    $month->addMonths($i);
                }
                break;
            case 'last7d':
                $ordersGrouped = array();
                for ($i=6; $i >= 0; $i--) {
                    $day = $today->subDays($i);
                    $o = $orders->where('day', '=', $day->format("Y-m-d"));
                    $ordersGrouped[$day->format("Y-m-d")] = array('date' => $day->format("F d"), 'count' => $o->count(), 'revenue' => $o->sum('total'));
                    $day->addDays($i);
                }
                break;
            case 'last30d': default:
                $ordersGrouped = array();
                for ($i=29; $i >= 0; $i--) {
                    $day = $today->subDays($i);
                    $o = $orders->where('day', '=', $day->format("Y-m-d"));
                    $ordersGrouped[$day->format("Y-m-d")] = array('date' => $day->format("F d"), 'count' => $o->count(), 'revenue' => $o->sum('total'));
                    $day->addDays($i);
                }
                break;
        }

        $transactions = Transaction::all();
        $inventory = Inventory::all();

        return view('orders',['orders' => $orders, 'transactions' => $transactions, 'inventory' => $inventory, 'ordersGrouped' => $ordersGrouped]);
    }

    public function Dashboard(Request $request) {
        if (isset($request->dashboardDates)) {
            session(['dashboardDates' => $request->dashboardDates]);
            $dates = session('dashboardDates');
        } else {
            $dates = session('dashboardDates');
        }

        $orders = Order::selectRaw('*, DATE_FORMAT(created_at, "%Y") as year, DATE_FORMAT(created_at, "%Y-%m") as month, DATE_FORMAT(created_at, "%Y-%m-%d") as day')->get();
        $users = User::selectRaw('*, DATE_FORMAT(created_at, "%Y") as year, DATE_FORMAT(created_at, "%Y-%m") as month, DATE_FORMAT(created_at, "%Y-%m-%d") as day')->get();
        // $transactions = Transaction::all();
        $transactions = Transaction::selectRaw("*, SUM(item_total) as revenue, COUNT(item_total) as orders, SUM(item_qty) as qty")->groupByRaw('prod_id')->orderByDesc('revenue')->get();
        $inventory = Inventory::select('*')->orderByDesc('prod_revenue')->paginate(12);

        $today = Carbon::today();

        switch ($dates) {
            case 'last5y':
                for ($i=4; $i >= 0; $i--) {
                    $year = $today->subYears($i);
                    $o = $orders->where('year', '=', $year->format("Y"));
                    $ordersGrouped[$year->format("Y")] = array('date' => $year->format("Y"), 'count' => $o->count(), 'revenue' => $o->sum('total'));
                    $u = $users->where('year', '=', $year->format("Y"));
                    $usersGrouped[$year->format("Y")] = array('date' => $year->format("Y"), 'count' => $u->count());
                    $year->addYears($i);
                }
                $transactionsGrouped = Transaction::selectRaw('*, SUM(item_total) as revenue, COUNT(item_total) as orders, SUM(item_qty) as qty')->where("created_at", ">=", $today->subYears(4)->format("Y")."01-01 00:00:00")->groupBy('prod_id')->orderByDesc('revenue')->paginate(12);
                break;
            case 'last30d':
                for ($i=29; $i >= 0; $i--) {
                    $day = $today->subDays($i);
                    $o = $orders->where('day', '=', $day->format("Y-m-d"));
                    $ordersGrouped[$day->format("Y-m-d")] = array('date' => $day->format("F d"), 'count' => $o->count(), 'revenue' => $o->sum('total'));
                    $u = $users->where('date', '=', $day->format("Y-m-d"));
                    $usersGrouped[$day->format("Y-m-d")] = array('date' => $day->format("F d"), 'count' => $u->count());
                    $day->addDays($i);
                }
                $transactionsGrouped = Transaction::selectRaw('*, SUM(item_total) as revenue, COUNT(item_total) as orders, SUM(item_qty) as qty')->where("created_at", ">=", $today->subDays(29)->format("Y-m-d")." 00:00:00")->groupBy('prod_id')->orderByDesc('revenue')->paginate(12);
                break;
            case 'last7d':
                for ($i=6; $i >= 0; $i--) {
                    $day = $today->subDays($i);
                    $o = $orders->where('day', '=', $day->format("Y-m-d"));
                    $ordersGrouped[$day->format("Y-m-d")] = array('date' => $day->format("F d"), 'count' => $o->count(), 'revenue' => $o->sum('total'));
                    $u = $users->where('date', '=', $day->format("Y-m-d"));
                    $usersGrouped[$day->format("Y-m-d")] = array('date' => $day->format("F d"), 'count' => $u->count());
                    $day->addDays($i);
                }
                $transactionsGrouped = Transaction::selectRaw('*, SUM(item_total) as revenue, COUNT(item_total) as orders, SUM(item_qty) as qty')->where("created_at", ">=", $today->subDays(6)->format("Y-m-d")." 00:00:00")->groupBy('prod_id')->orderByDesc('revenue')->paginate(12);
                break;
            case 'last12m': default:
                for ($i=11; $i >= 0; $i--) {
                    $month = $today->subMonths($i);
                    $o = $orders->where('month', '=', $month->format("Y-m"));
                    $ordersGrouped[$month->format("Y-m")] = array('date' => $month->format("F Y"), 'count' => $o->count(), 'revenue' => $o->sum('total'));
                    $u = $users->where('month', '=', $month->format("Y-m"));
                    $usersGrouped[$month->format("Y-m")] = array('date' => $month->format("F Y"), 'count' => $u->count());
                    $month->addMonths($i);
                }
                $transactionsGrouped = Transaction::selectRaw('*, SUM(item_total) as revenue, COUNT(item_total) as orders, SUM(item_qty) as qty')->where("created_at", ">=", $today->subMonths(11)->format("Y-m")."-01 00:00:00")->groupBy('prod_id')->orderByDesc('revenue')->paginate(12);
                break;
        }

        return view('admin',['orders' => $orders, 'transactions' => $transactions, 'inventory' => $inventory, 'users' => $users, 'ordersGrouped' => $ordersGrouped, 'usersGrouped' => $usersGrouped, 'transactionsGrouped' => $transactionsGrouped]);
    }
}
