<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Field;
use Carbon;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index() {
      Carbon::setLocale('es');
      if(!$this->hasrole('Admin')) { return redirect('/'); }
    	$products = Product::orderBy('updated_at', 'desc')->get();
    	return view('admin.products.index', compact('products'));
    }
    public function store(Request $request) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
    	  $this->validate(request(), [
          'name' => ['required', 'max:100'],
          'code' => ['unique:products']
        ]);

        $product = new Product;
        $product->code = $request->code;
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
            'name' => ['required', 'max:250'],
            'code' => ['unique:products,id,'.$product->id,'required', 'max:100']
        ]);


        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->presentation = $request->presentation;
        $product->code = $request->code;
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
        flash('Record deleted')->success();
        return redirect()->action('Admin\ProductController@index');
    }
}
