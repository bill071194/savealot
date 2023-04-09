<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function shop()
    {
        $inventories = Inventory::all();
        foreach ($inventories as $item) {
            if (session("cart-$item->id") > 0) {
            } else {
                session(["cart-$item->id" => 0]);
            }
        }
        $inventory = inventory::where('prod_quantity', '>', 0)->where('prod_selling_price', '>', 0)->orderByDesc('prod_revenue', 'prod_sold')->paginate(12);
        return view('shop',['inventory' => $inventory]);
    }

    public function search(Request $request)
    {
        $inventories = Inventory::all();
        foreach ($inventories as $item) {
            if (session("cart-$item->id") > 0) {
            } else {
                session(["cart-$item->id" => 0]);
            }
        }
        $inventory = Inventory::where('prod_name', 'LIKE', '%' . request('search') . '%')->orWhere('prod_description', 'LIKE', '%' . request('search') . '%')->orderByDesc('prod_revenue', 'prod_sold')->paginate(12);
        return view('/shop')->with('inventory', $inventory);
    }

    public function addToCart(string $id, Request $request)
    {
        session()->increment("cart-$id");
        if ($request->redirect == "redirectToCart") {
            return redirect()->action([InventoryController::class, 'cart']);
        } else {
            return redirect(url()->previous()."#id-$id");
        }
    }

    public function removeFromCart(string $id, Request $request)
    {
        session()->decrement("cart-$id");
        if ($request->redirect == "redirectToCart") {
            return redirect()->action([InventoryController::class, 'cart']);
        } else {
            return redirect(url()->previous()."#id-$id");
        }
    }

    public function emptyCart()
    {
        $inventories = Inventory::all();
        foreach ($inventories as $item) {
            session(["cart-$item->id" => 0]);
        }
        return redirect()->action([InventoryController::class, 'shop']);
    }
    
    public function cart()
    {
        //
        $inventory = inventory::orderByDesc('prod_revenue', 'prod_sold')->get();
        foreach ($inventory as $item) {
            if (session("cart-$item->id") > $item->prod_quantity) {
                $difference = session("cart-$item->id") - $item->prod_quantity;
                session(["cart-$item->id" => $item->prod_quantity]);
                session()->flash('cart-update', 'true');
                session()->flash("cart-update-$item->id", 'true');
                session()->flash("cart-update-$item->id-message", "Sorry, our stock of $item->prod_name has reduced and we have removed $difference of them from your cart.");
            }
        }
        return view('cart',['inventory' => $inventory]);
    }

    public function homepage()
    {
        $inventories = Inventory::all();
        foreach ($inventories as $item) {
            if (session("cart-$item->id") > 0) {
            } else {
                session(["cart-$item->id" => 0]);
            }
        }
        $inventory = $inventories;
        return view('index',['inventory' => $inventory]);
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
            'picture_upload' => 'required|image',
            'prod_name' => 'unique:inventories|required|max:255',
            'prod_quantity' => 'required',
        ]);
        
        $file = $request->file('picture_upload');
        
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
        $inventory->prod_picture = "storage/pics/".$file->getClientOriginalName();
        $inventory->prod_color = $request->prod_color;
        $inventory->competitor_saveonfoods = $request->competitor_saveonfoods;
        $inventory->competitor_tnt = $request->competitor_tnt;
        $inventory->competitor_walmart = $request->competitor_walmart;

        $file->storeAs('public', 'pics/'.$file->getClientOriginalName());


        // if successful we want to redirect
        if ($inventory->save()) {
            return redirect('/inventory');
        } else {
            return back()->withInput();
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
            'prod_quantity' => 'required',
        ]);

        $id = $request->id;
        $inventory = Inventory::whereId($id);

        if ($inventory->update($request->except(['_token']))) {
            return redirect("inventory#items");
        } else {
            return back()->withInput();
        }
    }

    /*
    * Update the quantity only
    */
    public function updateQuantity(Request $request, String $id)
    {
        $updateQty = $request->updateQty;
        $inventory = Inventory::findOrFail($id);
        $inventory->prod_quantity += $updateQty;

        if ($inventory->update()) {
            return redirect(url()->previous()."#id-$id");
        } else {
            return back();
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
            return redirect(url()->previous()."#items");
        } else {
            return back();
        }
    }
    
    public function uploadPicture() {
        return view('inventory.uploadpicture');
    } // inventory.uploadpicture
    
    public function movePicture(Request $request) {
        $file = $request->file('image');
        $file->storeAs('public', 'pics/'.$file->getClientOriginalName());
        
        return redirect('/inventory');
    } // submit image file uploaded
    
    public function uploadCSV() {
        return view('inventory.uploadfile');
    } // inventory.uploadfile
    
    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;
    
        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
    
        return $data;
    }
    
    public function importCSV(Request $request) {
        $file = $request->file('inventory_csv');
    
        $inventoryArr = $this->csvToArray($file);

        for ($i = 0; $i < count($inventoryArr); $i ++)
        {
            Inventory::firstOrCreate($inventoryArr[$i]);
        }

        return redirect('/inventory');
    }
}
