<?php

namespace App\Http\Controllers;
use App\User;
use App\Order;
use App\Cart;
use Auth;

use Illuminate\Http\Request;

class OrderController extends Controller
{
  public function index() {
    $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
    return view('orders.index', compact('orders'));
  }
  public function store(Request $request)
  {
    $products = [];
    $subtotal = 0;
    foreach(Auth::user()->carts as $cart) {
      $totalprod = $cart->quantity * $cart->product->price;
      $subtotal += $totalprod;
      array_push($products, [
        'name' => $cart->product->name,
        'category' => $cart->product->category->name,
        'price' => $cart->product->price,
        'quantity' => $cart->quantity,
        'total' => $totalprod
      ]);
      $cart->destroy($cart->id);
    }

    $order = new Order;
    $order->user_id = Auth::user()->id;
    $order->products = json_encode($products);
    $order->subtotal = $subtotal;
    $order->taxes = 0;
    $order->shipping = 0;
    $order->total = $order->subtotal + $order->taxes + $order->shipping;
    $order->comments = $request->comments;
    $order->status = "Pendiente";
    $order->save();

    Auth::user()->budget -= $order->total;
    Auth::user()->save();


    flash('Tu pedido se ha enviado correctamente')->success();
    return redirect()->action('WebController@index');
  }
  public function update($id, Request $request) {
    $cart = Order::where('user_id', Auth::user()->id)->where('id', $id)->first();
    $cart->quantity = $request->quantity;
    $cart->save();
    flash('Carro actualizado')->success();
    return redirect()->action('OrderController@index');
  }
  public function destroy($id) {
    $cart = Order::where('user_id', Auth::user()->id)->where('id', $id)->first();
    Order::destroy($cart->id);
    flash('Carro actualizado')->success();
    return redirect()->action('OrderController@index');
  }
}
