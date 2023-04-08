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

        foreach ($inventory as $item) {
            if (session("cart-$item->id") > 0) {
                $prod_name = $item->prod_name;
                $prod_picture = $item->prod_picture;
                $prod_price = $item->prod_selling_price;
                $item_qty = session("cart-$item->id");
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

        if ($order->save()) {
            // session('status') = 'Purchase Successful!';
            $row = Order::all()->sortBy('id')->last();
            $order_id = $row['id'];
            foreach ($inventory as $item) {
                if (session("cart-$item->id") > 0) {
                    $prod_name = $item->prod_name;
                    $prod_picture = $item->prod_picture;
                    $prod_price = $item->prod_selling_price;
                    $item_qty = session("cart-$item->id");
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
                    session(["cart-$item->id" => 0]);
                    // Inventory
                    $item->prod_quantity -= $item_qty;
                    $item->prod_sold += $item_qty;
                    $item->prod_revenue += $item_total;
                    $item->update();
                }
            }
            return redirect('/orderhistory');
        } else {
            return redirect('/cart');
        }
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $updateQty = $request->updateQty;
        $transaction = Transaction::findOrFail($id);
        $prod_price = $transaction->prod_price;
        $order = Order::findOrFail($transaction->order_id);
        $item = Inventory::findOrFail($transaction->prod_id);

        $transaction->item_qty += $updateQty;
        $transaction->item_total += $updateQty * $prod_price;

        $item->prod_quantity -= $updateQty;
        $item->prod_sold += $updateQty;
        $item->prod_revenue += $updateQty * $prod_price;

        $order->subtotal += $updateQty * $prod_price;

        if ($order->student == 1) {
            $discount = number_format($order->subtotal * 0.1, 2, '.', '');
            $order->discount = $discount;
            $order->total = $order->subtotal - $discount;
        } else {
            $order->total = $order->subtotal;
        }

        if ($transaction->update()) {
            $item->update();
            $order->update();
            return redirect(url()->previous()."#id-$transaction->order_id");
        } else {
            return back()->withInput();
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $order = Order::findOrFail($id);

        if ($order->delete()) {
            $transactions = Transaction::where('order_id', '=', $id)->get();
            $inventory = Inventory::all();
            foreach ($transactions as $transaction) {
                foreach ($inventory as $item) {                 // this foreach loop is necessary for reasons I don't understand
                    if ($item->id == $transaction->prod_id) {   // efficient methods throw "does not exist" exceptions
                        $item_qty = $transaction->item_qty;
                        $item_total = $transaction->item_total;
                        $item->prod_quantity += $item_qty;      // efficient methods throw "does not exist" on $item->prod_quantity
                        $item->prod_sold -= $item_qty;          // probably on $item->prod_sold
                        $item->prod_revenue -= $item_total;     // and $item->prod_revenue too
                        $item->update();
                    }
                }
                $transaction->delete();
            }
            return back();
        } else {
            return back();
        }
    }

    public function orderHistory() {
        $orders = Order::selectRaw('*, DATE_FORMAT(created_at, "%M %D, %Y") as date, DATE_FORMAT(created_at, "%W %M %D, %Y, at %l:%i %p") as dateFull')->where('user_id', '=', auth()->id())->get()->sortByDesc('created_at');
        $transactions = Transaction::where('user_id', '=', auth()->id())->get();
        $inventory = Inventory::all();
        return view('orderhistory',['orders' => $orders, 'transactions' => $transactions, 'inventory' => $inventory]);
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

    public function allOrders() {
        $orders = Order::selectRaw('*, DATE_FORMAT(created_at, "%M %D, %Y") as date, DATE_FORMAT(created_at, "%W %M %D, %Y, at %l:%i %p") as dateFull')->orderByDesc('created_at')->paginate(12);
        $transactions = Transaction::all();
        $inventory = Inventory::all();

        session(['lastAdmin' => 'ordersList']);
        return view('admin.ordersList',['orders' => $orders, 'transactions' => $transactions, 'inventory' => $inventory]);
    } // admin.ordersList

    public function allUsers() {
        $users = User::selectRaw('*, DATE_FORMAT(created_at, "%M %D, %Y") as date, DATE_FORMAT(created_at, "%W %M %D, %Y, at %l:%i %p") as dateFull')->orderBy('created_at')->paginate(12);

        session(['lastAdmin' => 'usersList']);
        return view('admin.usersList',['users' => $users]);
    } // admin.usersList

}
