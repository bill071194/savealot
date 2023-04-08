<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use DB;

class AdminController extends Controller {
    
    /**
    * Display a listing of the inventory for editing.
    */
    public function inventoriesDashboard()
    {
        $inventories = Inventory::all();
        foreach ($inventories as $item) {
            if (session("cart-$item->id") > 0) {
            } else {
                session(["cart-$item->id" => 0]);
            }
        }
        $inventory = inventory::orderByDesc('prod_revenue', 'prod_sold')->paginate(12);
        session(['lastAdmin' => 'inventory']);
        return view('inventory',['inventory' => $inventory]);
    }
    
    public function adminRedirect(Request $request) {
        $lastAdmin = session('lastAdmin');
        switch ($lastAdmin) {
            case 'inventory':
                return redirect('/inventory');
            case 'orders':
                return redirect('/orders');
            case 'users':
                return redirect('/users');
            case 'transactions':
                return redirect('/transactions');
            case 'ordersList':
                return redirect('/ordersList');
            case 'usersList':
                return redirect('/usersList');
            case 'adminDashboard': default:
                return redirect('/adminDashboard');
        }
    } // admin.admin OR last admin page viewed
    
    public function adminDashboard(Request $request) {
        if (isset($request->dashboardDates)) {
            session(['dashboardDates' => $request->dashboardDates]);
        }
        $dates = session('dashboardDates');
        $today = Carbon::today();
    
        $orders = Order::selectRaw('*, DATE_FORMAT(created_at, "%Y") as year, DATE_FORMAT(created_at, "%Y-%m") as month, DATE_FORMAT(created_at, "%Y-%m-%d") as day')->get();
        $users = User::selectRaw('*, DATE_FORMAT(created_at, "%Y") as year, DATE_FORMAT(created_at, "%Y-%m") as month, DATE_FORMAT(created_at, "%Y-%m-%d") as day')->get();
        $transactions = Transaction::selectRaw("*, SUM(item_total) as revenue, COUNT(item_total) as orders, SUM(item_qty) as qty")->groupByRaw('prod_id')->orderByDesc('revenue')->get();
        $inventory = Inventory::select('*')->orderByDesc('prod_revenue')->paginate(12);
    
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
                    $u = $users->where('day', '=', $day->format("Y-m-d"));
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
                    $u = $users->where('day', '=', $day->format("Y-m-d"));
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
    
        session(['lastAdmin' => 'adminDashboard']);
        return view('admin.admin',['orders' => $orders, 'transactions' => $transactions, 'inventory' => $inventory, 'users' => $users, 'ordersGrouped' => $ordersGrouped, 'usersGrouped' => $usersGrouped, 'transactionsGrouped' => $transactionsGrouped]);
    } // admin.admin
    
    public function ordersDashboard(Request $request) {
        if (isset($request->dashboardDates)) {
            session(['dashboardDates' => $request->dashboardDates]);
        }
        $dates = session('dashboardDates');
        $today = Carbon::today();

        $orders = Order::selectRaw('*, DATE_FORMAT(created_at, "%Y") as year, DATE_FORMAT(created_at, "%Y-%m") as month, DATE_FORMAT(created_at, "%Y-%m-%d") as day')->get();

        switch ($dates) {
            case 'last5y':
                for ($i=4; $i >= 0; $i--) {
                    $year = $today->subYears($i);
                    $o = $orders->where('year', '=', $year->format("Y"));
                    $ordersGrouped[$year->format("Y")] = array('date' => $year->format("Y"), 'count' => $o->count(), 'revenue' => $o->sum('total'));
                    $year->addYears($i);
                }
                break;
            case 'last30d':
                for ($i=29; $i >= 0; $i--) {
                    $day = $today->subDays($i);
                    $o = $orders->where('day', '=', $day->format("Y-m-d"));
                    $ordersGrouped[$day->format("Y-m-d")] = array('date' => $day->format("F d"), 'count' => $o->count(), 'revenue' => $o->sum('total'));
                    $day->addDays($i);
                }
                break;
            case 'last7d':
                for ($i=6; $i >= 0; $i--) {
                    $day = $today->subDays($i);
                    $o = $orders->where('day', '=', $day->format("Y-m-d"));
                    $ordersGrouped[$day->format("Y-m-d")] = array('date' => $day->format("F d"), 'count' => $o->count(), 'revenue' => $o->sum('total'));
                    $day->addDays($i);
                }
                break;
            case 'last12m': default:
                for ($i=11; $i >= 0; $i--) {
                    $month = $today->subMonths($i);
                    $o = $orders->where('month', '=', $month->format("Y-m"));
                    $ordersGrouped[$month->format("Y-m")] = array('date' => $month->format("F Y"), 'count' => $o->count(), 'revenue' => $o->sum('total'));
                    $month->addMonths($i);
                }
                break;
        }

        session(['lastAdmin' => 'orders']);
        return view('admin.orders',['orders' => $orders, 'ordersGrouped' => $ordersGrouped]);
    } // admin.orders
    
    public function allOrders() {
        $orders = Order::selectRaw('*, DATE_FORMAT(created_at, "%M %D, %Y") as date, DATE_FORMAT(created_at, "%W %M %D, %Y, at %l:%i %p") as dateFull')->orderByDesc('created_at')->paginate(12);
        $transactions = Transaction::all();
        $inventory = Inventory::all();

        session(['lastAdmin' => 'ordersList']);
        return view('admin.ordersList',['orders' => $orders, 'transactions' => $transactions, 'inventory' => $inventory]);
    } // admin.ordersList
    
    public function usersDashboard(Request $request) {
        if (isset($request->dashboardDates)) {
            session(['dashboardDates' => $request->dashboardDates]);
        }
        $dates = session('dashboardDates');
        $today = Carbon::today();

        $users = User::selectRaw('*, DATE_FORMAT(created_at, "%Y") as year, DATE_FORMAT(created_at, "%Y-%m") as month, DATE_FORMAT(created_at, "%Y-%m-%d") as day')->get();

        switch ($dates) {
            case 'last5y':
                for ($i=4; $i >= 0; $i--) {
                    $year = $today->subYears($i);
                    $u = $users->where('year', '=', $year->format("Y"));
                    $usersGrouped[$year->format("Y")] = array('date' => $year->format("Y"), 'count' => $u->count());
                    $year->addYears($i);
                }
                break;
            case 'last30d':
                for ($i=29; $i >= 0; $i--) {
                    $day = $today->subDays($i);
                    $u = $users->where('day', '=', $day->format("Y-m-d"));
                    $usersGrouped[$day->format("Y-m-d")] = array('date' => $day->format("F d"), 'count' => $u->count());
                    $day->addDays($i);
                }
                break;
            case 'last7d':
                for ($i=6; $i >= 0; $i--) {
                    $day = $today->subDays($i);
                    $u = $users->where('day', '=', $day->format("Y-m-d"));
                    $usersGrouped[$day->format("Y-m-d")] = array('date' => $day->format("F d"), 'count' => $u->count());
                    $day->addDays($i);
                }
                break;
            case 'last12m': default:
                for ($i=11; $i >= 0; $i--) {
                    $month = $today->subMonths($i);
                    $u = $users->where('month', '=', $month->format("Y-m"));
                    $usersGrouped[$month->format("Y-m")] = array('date' => $month->format("F Y"), 'count' => $u->count());
                    $month->addMonths($i);
                }
                break;
        }

        session(['lastAdmin' => 'users']);
        return view('admin.users',['users' => $users, 'usersGrouped' => $usersGrouped]);
    } // admin.users
    
    public function allUsers() {
        $users = User::selectRaw('*, DATE_FORMAT(created_at, "%M %D, %Y") as date, DATE_FORMAT(created_at, "%W %M %D, %Y, at %l:%i %p") as dateFull')->orderBy('created_at')->paginate(12);

        session(['lastAdmin' => 'usersList']);
        return view('admin.usersList',['users' => $users]);
    } // admin.usersList
    
    public function deleteUser(request $request) 
    {
        $id = $request->id;
        $user = User::whereId($id);
        
        if ($user->update([
            'name'=>'deleted',
            'email'=>'deleted@localhost',
            'password'=>'deleted123!',
            'student'=>$request->student
            ])) 
        {
            return redirect('/usersList');
        } 
        else 
        {
            return back()->withInput();
        }
    } // usersList.delete
    
    public function transactionsDashboard(Request $request) {
        if (isset($request->dashboardDates)) {
            session(['dashboardDates' => $request->dashboardDates]);
        }
        $dates = session('dashboardDates');
        $today = Carbon::today();

        $orders = Order::selectRaw('*, DATE_FORMAT(created_at, "%Y") as year, DATE_FORMAT(created_at, "%Y-%m") as month, DATE_FORMAT(created_at, "%Y-%m-%d") as day')->get();
        $users = User::selectRaw('*, DATE_FORMAT(created_at, "%Y") as year, DATE_FORMAT(created_at, "%Y-%m") as month, DATE_FORMAT(created_at, "%Y-%m-%d") as day')->get();
        $transactions = Transaction::selectRaw("*, SUM(item_total) as revenue, COUNT(item_total) as orders, SUM(item_qty) as qty")->groupByRaw('prod_id')->orderByDesc('revenue')->get();
        $inventory = Inventory::select('*')->orderByDesc('prod_revenue')->paginate(12);

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
                    $u = $users->where('day', '=', $day->format("Y-m-d"));
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
                    $u = $users->where('day', '=', $day->format("Y-m-d"));
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

        session(['lastAdmin' => 'transactions']);
        return view('admin.transactions',['orders' => $orders, 'transactions' => $transactions, 'inventory' => $inventory, 'users' => $users, 'ordersGrouped' => $ordersGrouped, 'usersGrouped' => $usersGrouped, 'transactionsGrouped' => $transactionsGrouped]);
    } // admin.transactions
}