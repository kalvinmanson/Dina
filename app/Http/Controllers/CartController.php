<?php

namespace App\Http\Controllers;
use App\User;
use App\Cart;
use Auth;

use Illuminate\Http\Request;

class CartController extends Controller
{
  public function index() {
    $carts = Auth::user()->carts;
    return view('cart.index', compact('carts'));
  }
  public function store(Request $request)
  {
    $this->validate(request(), [
        'product_id' => ['required']
    ]);
    $cart = Cart::where('user_id', Auth::user()->id)->where('product_id', $request->product_id)->first();
    if($cart) {
      $cart->quantity += 1;
    } else {
      $cart = new Cart;
      $cart->user_id = Auth::user()->id;
      $cart->product_id = $request->product_id;
    }
    $cart->save();
    flash('Agregado al carro de compras')->success();
    return redirect()->action('WebController@index');
  }
  public function update($id, Request $request) {
    $cart = Cart::where('user_id', Auth::user()->id)->where('id', $id)->first();
    $cart->quantity = $request->quantity;
    $cart->save();
    flash('Carro actualizado')->success();
    return redirect()->action('CartController@index');
  }
  public function destroy($id) {
    $cart = Cart::where('user_id', Auth::user()->id)->where('id', $id)->first();
    Cart::destroy($cart->id);
    flash('Carro actualizado')->success();
    return redirect()->action('CartController@index');
  }
}
