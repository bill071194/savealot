<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    public function checkOut(Request $request) {
        $user_id = $request->user_id;
        $inventory = inventory::all();
        $subtotal = 0;
        $discount = 0;
        $total = 0;

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
        return view('admin',['orders' => $orders, 'transactions' => $transactions, 'inventory' => $inventory, 'users' => $users]);
    }

    public function allOrders() {
        $orders = Order::all();
        $transactions = Transaction::all();
        $inventory = Inventory::all();
        return view('orders',['orders' => $orders, 'transactions' => $transactions, 'inventory' => $inventory]);
    }

    public function allUsers() {
        $users = User::all();
        return view('users', ['users' => $users]);
    }
}
