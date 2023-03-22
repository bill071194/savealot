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
        $inventory = inventory::all();
        return view('inventory',['inventory' => $inventory]);
    }

    // Custom made
    public function shop()
    {
        //
        $inventory = inventory::all();
        return view('shop',['inventory' => $inventory]);
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
        ]);
        // process the data and submit it
        $inventory = new Inventory(); // this is the model Inventory
        $inventory->id = $request->id;
        $inventory->prod_name = $request->prod_name;

        // if successful we want to redirect
        if ($inventory->save()) {
            $inventory = inventory::all();
            return view('shop',['inventory' => $inventory]);
        } else {
            return view('/inventory/create');
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
    public function update(Request $request, inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(inventory $inventory)
    {
        //
    }
}
