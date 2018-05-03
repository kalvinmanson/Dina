<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Contract;
use Auth;
use Hash;
use Carbon;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
      Carbon::setLocale('es');
      if(!$this->hasrole('Admin')) { return redirect('/'); }
    	$users = User::all();
      $contracts = Contract::all();
    	return view('admin.users.index', compact('users', 'contracts'));
    }
    public function store(Request $request) {
      if(!$this->hasrole('Admin')) { return redirect('/'); }
      $this->validate(request(), [
          'name' => ['required', 'max:250'],
          'email' => ['required', 'unique:users'],
          'password' => ['required', 'max:250']
      ]);
      $user = new User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->username = str_slug($request->username . '-'.rand(0,1000));
      $user->contract_id = $request->contract_id;
      $user->save();

      flash('Cliente agregado')->success();
      return redirect()->action('Admin\UserController@index');
    }

    public function edit($id) {
        Carbon::setLocale('es');
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $user = User::find($id);
        $contracts = Contract::all();
        return view('admin.users.edit', compact('user', 'contracts'));
    }

    public function update($id, Request $request) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $user = User::find($id);
        $this->validate(request(), [
            'name' => ['required', 'max:100'],
            'username' => ['unique:users,username,'.$user->id, 'required', 'max:20'],
            'email' => ['unique:users,email,'.$user->id, 'required', 'max:150']
        ]);
        $user->contract_id = $request->contract_id;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = $request->role;
        //cambiar password
        if(!empty($request->password)) {
          $user->password = Hash::make($request->password);
        }

        $user->save();
        flash('Cliente actualizado')->success();
        return redirect()->action('Admin\UserController@index');
    }
}
