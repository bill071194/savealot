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
        // check if order can be executed
        foreach ($inventory as $item) {
            if (session("cart-$item->id") > $item->prod_quantity) {
                $difference = session("cart-$item->id") - $item->prod_quantity;
                session(["cart-$item->id" => $item->prod_quantity]);
                session(['stop-checkout' => 'true']);
                session()->flash('cart-update', 'true');
                session()->flash("cart-update-$item->id", 'true');
                session()->flash("cart-update-$item->id-message", "Sorry, our stock of $item->prod_name has reduced and we have removed $difference of them from your cart.");
            }
        }
        // give up and go back to cart page if order is not valid
        if (session('stop-checkout') != 'true') {
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

            // $DATE = Carbon::today()->subDays(0)->toDateTimeString();    // TEMPORARY FOR BACKDATED ORDERS
            // $order->created_at = $DATE;                                 // TEMPORARY FOR BACKDATED ORDERS

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
                        // $transaction->created_at = $DATE;   // TEMPORARY FOR BACKDATED ORDERS
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
        }else {
            session(['stop-checkout' => 'false']);
            return back()->withInput();
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
}
