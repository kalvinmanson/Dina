<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use Carbon;
use Auth;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index() {
      Carbon::setLocale('es');
      if(!$this->hasrole('Admin')) { return redirect('/'); }
    	$orders = Order::orderBy('updated_at', 'desc')->get();
      $users = User::all();
    	return view('admin.orders.index', compact('orders', 'users'));
    }

    public function update($id, Request $request) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $order = Order::find($id);
        $this->validate(request(), [
            'status' => ['required']
        ]);

        $order->status = $request->status;
        if($request->user_id && $order->user_id == Auth::user()->id) {
            $order->user_id = $request->user_id;
        }
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
