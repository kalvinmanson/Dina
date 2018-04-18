<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
    	$users = User::all();
    	return view('admin.users.index', compact('users'));
    }

    public function edit($id) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $user = User::find($id);
        $products = Product::all();
        return view('admin.users.edit', compact('user', 'products'));
    }

    public function update($id, Request $request) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $user = User::find($id);
        $this->validate(request(), [
            'name' => ['required', 'max:100']
        ]);
        $user->name = $request->name;
        $user->role = $request->role;

        $user->products()->detach();
        $user->products()->attach($request->products);

        $user->save();
        flash('Record updated')->success();
        return redirect()->action('Admin\UserController@index');
    }
}
