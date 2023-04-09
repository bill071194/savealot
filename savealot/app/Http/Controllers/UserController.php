<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('shop.shop');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the form data
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' => 'required|max:255'
        ]);
        // process the data and submit it
        $user = new User(); // this is the model User
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        // if successful we want to redirect
        if ($user->save()) {
            return redirect()->route('user.index');
        } else {
            return redirect()->route('user.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id = $request->id;
        $this->validate($request, [
            'email' => "required|unique:users,email,$id|max:255",
        ]);
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password != "") {
            $user->password = Hash::make($request->password);
        }
        $user->email = $request->email;
        $user->student = $request->student;

        // if successful we want to redirect
        if ($user->save()) {
            return redirect(url()->previous()."#id-$id");
        } else {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $id = $request->id;
        $this->validate($request, [
            'email' => "required|unique:users,email,$id|max:255",
        ]);
        $userOld = User::findOrFail($id);
        $user = new User();
        $user->name = "deleted";
        $user->email = $request->email;
        $user->password = 'admin';
        $user->password = Hash::make("admin");
        $user->student = $userOld->student;
        $user->created_at = $userOld->created_at;

        // if successful we want to redirect
        if ($user->save()) {
            $userOld->delete();
            return back();
        } else {
            return back();
        }
    }
}
