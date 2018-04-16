<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Category;
use App\Field;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index() {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
    	$categories = Category::withTrashed()->get();
    	return view('admin.categories.index', compact('categories'));
    }
    public function store(Request $request) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
    	$this->validate(request(), [
            'name' => ['required', 'max:100']
        ]);

        $category = new Category;
        $category->name = $request->name;
        //Validar unico slug
        $slug = str_slug($request->name);
        $validate = Category::where('slug', $slug)->get();
        if(count($validate) > 0) {
            $slug = $slug . '-' . count($validate);
        }
        $category->slug = $slug;
        $category->save();
        flash('Record created')->success();
        return redirect()->action('Admin\CategoryController@index');
    }

    public function edit($id) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $category = Category::withTrashed()->find($id);
        $fields = Field::where('category_id', '>', 0)->select('name')->groupBy('name')->get();
        $formats = Field::where('category_id', '>', 0)->select('format')->groupBy('format')->get();

        return view('admin.categories.edit', compact('category', 'fields', 'formats'));
    }

    public function update($id, Request $request) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }

        $category = Category::withTrashed()->find($id);
        $this->validate(request(), [
            'name' => ['required', 'max:100']
        ]);
        //restore trashed item
        if($request->untrash) {
            $category->restore();
        }
        
        $category->name = $request->name;
        $category->picture = $request->picture;
        $category->description = $request->description;
        $category->content = $request->content;
        $category->save();

        flash('Record updated')->success();
        return redirect()->action('Admin\CategoryController@index');
    }
    public function destroy($id) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $category = Category::withTrashed()->find($id);
        if($category->trashed()) {
            $category->forceDelete();
        }
        Category::destroy($category->id);
        flash('Record deleted')->success();
        return redirect()->action('Admin\CategoryController@index');
    }
}
