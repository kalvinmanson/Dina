<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Field;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index() {
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
        $product = Product::withTrashed()->find($id);
        $categories = Category::all();
        $fields = Field::where('product_id', '>', 0)->select('name')->groupBy('name')->get();
        $formats = Field::where('product_id', '>', 0)->select('format')->groupBy('format')->get();
        return view('admin.products.edit', compact('product', 'categories', 'fields', 'formats'));
    }

    public function update($id, Request $request) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $product = Product::withTrashed()->find($id);
        $this->validate(request(), [
            'name' => ['required', 'max:200'],
            'slug' => ['unique:products,slug,'.$product->id, 'required', 'max:100']
        ]);
        //restore trashed item
        if($request->untrash) {
            $product->restore();
        }

        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->picture = $request->picture;
        $product->description = $request->description;
        $product->content = $request->content;
        $product->weight = $request->weight;
        $product->save();

        flash('Record updated')->success();
        return redirect()->action('Admin\ProductController@index');
    }
    public function destroy($id) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $product = Product::withTrashed()->find($id);
        if($product->trashed()) {
            $product->forceDelete();
        }
        Product::destroy($product->id);
        flash('Record deleted')->success();
        return redirect()->action('Admin\ProductController@index');
    }
}
