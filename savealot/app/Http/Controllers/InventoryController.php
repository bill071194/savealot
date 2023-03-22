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
