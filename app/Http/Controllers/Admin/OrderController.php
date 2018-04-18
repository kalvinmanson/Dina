<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Order;
use App\Field;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index() {
      if(!$this->hasrole('Admin')) { return redirect('/'); }
    	$orders = Order::orderBy('updated_at', 'desc')->get();
    	return view('admin.orders.index', compact('orders'));
    }
    public function store(Request $request) {
      if(!$this->hasrole('Admin')) { return redirect('/'); }
  	  $this->validate(request(), [
        'name' => ['required', 'max:100'],
        'code' => ['unique:orders']
      ]);

      $order = new Order;
      $order->code = $request->code;
      $order->name = $request->name;
      $order->category_id = Category::first()->id;
      $order->save();
      flash('Record created')->success();
      return redirect()->action('Admin\OrderController@index');
    }

    public function edit($id) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $order = Order::find($id);
        $categories = Category::all();
        return view('admin.orders.edit', compact('order', 'categories'));
    }

    public function update($id, Request $request) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $order = Order::find($id);
        $this->validate(request(), [
            'status' => ['required']
        ]);

        $order->status = $request->status;
        $order->save();

        //Restore budget
        if($request->status == 'Cancelado') {
          $order->user->budget += $order->total;
          $order->user->save();
        }

        flash('Record updated')->success();
        return redirect()->action('Admin\OrderController@index');
    }
}
