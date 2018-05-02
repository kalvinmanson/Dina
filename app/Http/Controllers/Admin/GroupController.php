<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Group;
use App\Product;
use Carbon;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    public function index() {
      Carbon::setLocale('es');
      if(!$this->hasrole('Admin')) { return redirect('/'); }
    	$groups = Group::orderBy('updated_at', 'desc')->get();
    	return view('admin.groups.index', compact('groups'));
    }
    public function store(Request $request) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
    	  $this->validate(request(), [
          'name' => ['required']
        ]);

        $group = new Group;
        $group->name = $request->name;
        $group->save();
        flash('Record created')->success();
        return redirect()->action('Admin\GroupController@index');

    }

    public function edit($id) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $group = Group::find($id);
        $products = Product::all();
        return view('admin.groups.edit', compact('group', 'products'));
    }

    public function update($id, Request $request) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $group = Group::find($id);
        $this->validate(request(), [
            'name' => ['required', 'max:250']
        ]);

        $group->name = $request->name;
        $group->description = $request->description;

        $group->products()->detach();
        $group->products()->attach($request->products);

        $group->save();

        flash('Record updated')->success();
        return redirect()->action('Admin\GroupController@index');
    }
    public function destroy($id) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $group = Group::find($id);
        Group::destroy($group->id);
        flash('Record deleted')->success();
        return redirect()->action('Admin\GroupController@index');
    }
}
