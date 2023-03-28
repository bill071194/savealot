{"changed":true,"filter":false,"title":"InventoryController.php","tooltip":"/savealot/app/Http/Controllers/InventoryController.php","value":"<?php\n\nnamespace App\\Http\\Controllers;\n\nuse App\\Models\\Inventory;\nuse Illuminate\\Http\\Request;\n\nclass InventoryController extends Controller\n{\n    /**\n     * Display a listing of the resource.\n     */\n    public function index()\n    {\n        //\n        $inventory = inventory::where('prod_quantity', '>', 0)->where('prod_selling_price', '>', 0)->get();\n        foreach ($inventory as $item) {\n            if (session(\"$item->id\") < 1) {\n                session([\"$item->id\" => 0]);\n            }\n        }\n        return view('inventory',['inventory' => $inventory]);\n    }\n\n    // Custom made\n    public function shop()\n    {\n        //\n        $inventory = inventory::where('prod_quantity', '>', 0)->where('prod_selling_price', '>', 0)->paginate(12);\n        foreach ($inventory as $item) {\n            if (session(\"$item->id\") < 1) {\n                session([\"$item->id\" => 0]);\n            }\n        }\n        return view('shop',['inventory' => $inventory]);\n    }\n    \n    public function search(Request $request)\n    {\n        $inventory = Inventory::where('prod_name', 'LIKE', '%' . request('search') . '%')->orWhere('prod_description', 'LIKE', '%' . request('search') . '%')->paginate(12);\n        foreach ($inventory as $item) {\n            if (session(\"$item->id\") < 1) {\n                session([\"$item->id\" => 0]);\n            }\n        }\n        return view('/shop')->with('inventory', $inventory);\n    }\n\n    public function addToCart(string $id)\n    {\n        session()->increment(\"$id\");\n        return redirect()->action([InventoryController::class, 'shop']);\n    }\n\n    public function removeFromCart(string $id)\n    {\n        session()->decrement(\"$id\");\n        return redirect()->action([InventoryController::class, 'shop']);\n    }\n\n    public function emptyCart()\n    {\n        $inventory = inventory::all();\n        foreach ($inventory as $item) {\n            session([\"$item->id\" => 0]);\n        }\n        return redirect()->action([InventoryController::class, 'shop']);\n    }\n\n    public function homepage()\n    {\n        $inventory = inventory::all();\n        return view('index',['inventory' => $inventory]);\n    }\n\n    public function cart()\n    {\n        //\n        $inventory = inventory::all();\n        return view('cart',['inventory' => $inventory]);\n    }\n\n    /**\n     * Show the form for creating a new resource.\n     */\n    public function create()\n    {\n        //\n        return view('/inventory/create');\n    }\n\n    /**\n     * Store a newly created resource in storage.\n     */\n    public function store(Request $request)\n    {\n        // validate the form data\n        $this->validate($request, [\n            'prod_name' => 'required|max:255',\n            'prod_description' => 'max:255',\n            'prod_quantity' => 'required'\n        ]);\n        // process the data and submit it\n        $inventory = new Inventory(); // this is the model Inventory\n        $inventory->id = $request->id;\n        $inventory->prod_name = $request->prod_name;\n        $inventory->prod_description = $request->prod_description;\n        $inventory->prod_purchase_price = $request->prod_purchase_price;\n        $inventory->prod_selling_price = $request->prod_selling_price;\n        $inventory->prod_units = $request->prod_units;\n        $inventory->prod_size = $request->prod_size;\n        $inventory->prod_quantity = $request->prod_quantity;\n        $inventory->prod_exp_date = $request->prod_exp_date;\n        $inventory->prod_picture = $request->prod_picture;\n\n\n        // if successful we want to redirect\n        if ($inventory->save()) {\n            return redirect()->action([InventoryController::class, 'shop']);\n        } else {\n            return redirect('/inventory/create');\n        }\n    }\n\n    /**\n     * Display the specified resource.\n     */\n\n    public function show(string $id)\n    {\n        // find the record\n        $inventory = Inventory::findOrFail($id);\n        // return this view\n        return view('inventory.show')->with('item', $inventory);\n    }\n\n    /**\n     * Show the form for editing the specified resource.\n     */\n    public function edit(string $id)\n    {\n        // find the record\n        $inventory = Inventory::findOrFail($id);\n        // return this view\n        return view('inventory.edit')->with('item', $inventory);\n    }\n\n    /**\n     * Update the specified resource in storage.\n     */\n    public function update(Request $request)\n    {\n        // validate the form data\n        $this->validate($request, [\n            'prod_name' => 'required|max:255',\n            'prod_description' => 'max:255'\n        ]);\n\n        $id = $request->id;\n        $inventory = Inventory::whereId($id);\n\n        if ($inventory->update($request->except(['_token']))) {\n            return redirect('/inventory');\n        } else {\n            return redirect()->action([InventoryController::class, 'edit']);\n        }\n    }\n\n    /**\n     * Remove the specified resource from storage.\n     */\n    public function destroy(Request $request)\n    {\n        $id = $request->id;\n        $inventory = Inventory::whereId($id);\n        if ($inventory->delete()) {\n            return redirect('/inventory');\n        } else {\n            return redirect()->action([InventoryController::class, 'edit']);\n        }\n    }\n}\n","undoManager":{"mark":-2,"position":0,"stack":[[{"start":{"row":36,"column":0},"end":{"row":40,"column":48},"action":"remove","lines":["<<<<<<< HEAD","    ","=======","",">>>>>>> 43bfdd83a0bc72d0e527b9d150c67ba78601277e"],"id":2},{"start":{"row":36,"column":0},"end":{"row":36,"column":4},"action":"insert","lines":["    "]}]]},"ace":{"folds":[],"scrolltop":636.52001953125,"scrollleft":0,"selection":{"start":{"row":0,"column":0},"end":{"row":0,"column":0},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":32,"state":"php-start","mode":"ace/mode/php"}},"timestamp":1679595643499}