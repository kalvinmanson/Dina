<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Cart;
use Carbon;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(Request $request) {
      Carbon::setLocale('es');
      if(!$this->hasrole('Admin')) { return redirect('/'); }
    	$products = Product::orderBy('updated_at', 'desc');
      if($request->q) {
        $products = $products->where('name', 'LIKE', '%'.$request->q.'%');
      }
      $products = $products->paginate(20);
      $totalprods = Product::all();
    	return view('admin.products.index', compact('products', 'totalprods'));
    }
    public function store(Request $request) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
    	  $this->validate(request(), [
          'name' => ['required', 'max:100'],
        ]);

        $product = new Product;
        $product->name = $request->name;
        $product->category_id = Category::first()->id;
        $product->save();
        flash('Record created')->success();
        return redirect()->action('Admin\ProductController@index');

    }

    public function edit($id) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update($id, Request $request) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $product = Product::find($id);
        $this->validate(request(), [
            'name' => ['required', 'max:250']
        ]);


        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->presentation = $request->presentation;
        $product->price = $request->price;
        $product->picture = $request->picture;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->save();

        flash('Record updated')->success();
        return redirect()->action('Admin\ProductController@index');
    }
    public function destroy($id) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $product = Product::find($id);
        Product::destroy($product->id);
        Cart::where('product_id', $product->id)->delete();

        flash('Record deleted')->success();
        return redirect()->action('Admin\ProductController@index');
    }
}
