<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $inventory = inventory::where('prod_quantity', '>', 0)->where('prod_selling_price', '>', 0)->get();
        foreach ($inventory as $item) {
            if (session("$item->id") < 1) {
                session(["$item->id" => 0]);
            }
        }
        return view('inventory',['inventory' => $inventory]);
    }

    // Custom made
    public function shop()
    {
        //
        $inventory = inventory::where('prod_quantity', '>', 0)->where('prod_selling_price', '>', 0)->paginate(12);
        foreach ($inventory as $item) {
            if (session("$item->id") < 1) {
                session(["$item->id" => 0]);
            }
        }
        return view('shop',['inventory' => $inventory]);
    }
    
    public function search(Request $request)
    {
        $inventory = Inventory::where('prod_name', 'LIKE', '%' . request('search') . '%')->orWhere('prod_description', 'LIKE', '%' . request('search') . '%')->paginate(12);
        foreach ($inventory as $item) {
            if (session("$item->id") < 1) {
                session(["$item->id" => 0]);
            }
        }
        return view('/shop')->with('inventory', $inventory);
    }

    public function addToCart(string $id)
    {
        session()->increment("$id");
        return redirect()->action([InventoryController::class, 'shop']);
    }

    public function removeFromCart(string $id)
    {
        session()->decrement("$id");
        return redirect()->action([InventoryController::class, 'shop']);
    }

    public function emptyCart()
    {
        $inventory = inventory::all();
        foreach ($inventory as $item) {
            session(["$item->id" => 0]);
        }
        return redirect()->action([InventoryController::class, 'shop']);
    }

    public function homepage()
    {
        $inventory = inventory::all();
        return view('index',['inventory' => $inventory]);
    }

    public function cart()
    {
        //
        $inventory = inventory::all();
        return view('cart',['inventory' => $inventory]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('/inventory/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the form data
        $this->validate($request, [
            'prod_name' => 'required|max:255',
            'prod_description' => 'max:255',
            'prod_quantity' => 'required'
        ]);
        // process the data and submit it
        $inventory = new Inventory(); // this is the model Inventory
        $inventory->id = $request->id;
        $inventory->prod_name = $request->prod_name;
        $inventory->prod_description = $request->prod_description;
        $inventory->prod_purchase_price = $request->prod_purchase_price;
        $inventory->prod_selling_price = $request->prod_selling_price;
        $inventory->prod_units = $request->prod_units;
        $inventory->prod_size = $request->prod_size;
        $inventory->prod_quantity = $request->prod_quantity;
        $inventory->prod_exp_date = $request->prod_exp_date;
        $inventory->prod_picture = $request->prod_picture;


        // if successful we want to redirect
        if ($inventory->save()) {
            return redirect()->action([InventoryController::class, 'shop']);
        } else {
            return redirect('/inventory/create');
        }
    }

    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {
        // find the record
        $inventory = Inventory::findOrFail($id);
        // return this view
        return view('inventory.show')->with('item', $inventory);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // find the record
        $inventory = Inventory::findOrFail($id);
        // return this view
        return view('inventory.edit')->with('item', $inventory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // validate the form data
        $this->validate($request, [
            'prod_name' => 'required|max:255',
            'prod_description' => 'max:255'
        ]);

        $id = $request->id;
        $inventory = Inventory::whereId($id);

        if ($inventory->update($request->except(['_token']))) {
            return redirect('/inventory');
        } else {
            return redirect()->action([InventoryController::class, 'edit']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $inventory = Inventory::whereId($id);
        if ($inventory->delete()) {
            return redirect('/inventory');
        } else {
            return redirect()->action([InventoryController::class, 'edit']);
        }
    }
}
