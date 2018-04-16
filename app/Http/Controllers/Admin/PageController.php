<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Page;
use App\Category;
use App\Field;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function duplicate(Request $request) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $page = Page::find($request->id);
        $newPage = $page->replicate();
        $newPage->slug = $newPage->slug .'-copy-'.rand(100,999);
        $newPage->save();

        return redirect()->action('Admin\PageController@edit', $newPage->id);
    }
    public function index() {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
    	$pages = Page::withTrashed()->orderBy('updated_at', 'desc')->get();
    	return view('admin.pages.index', compact('pages'));
    }
    public function store(Request $request) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
    	$this->validate(request(), [
            'name' => ['required', 'max:100']
        ]);

        $page = new Page;
        $page->name = $request->name;
        //Validar unico slug
        $slug = str_slug($request->name);
        $validate = Page::where('slug', $slug)->get();
        if(count($validate) > 0) {
            $slug = $slug . '-' . count($validate);
        }
        $page->slug = $slug;
        $page->category_id = Category::first()->id;
        $page->save();
        flash('Record created')->success();
        return redirect()->action('Admin\PageController@index');

    }

    public function edit($id) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $page = Page::withTrashed()->find($id);
        $categories = Category::all();
        $fields = Field::where('page_id', '>', 0)->select('name')->groupBy('name')->get();
        $formats = Field::where('page_id', '>', 0)->select('format')->groupBy('format')->get();
        return view('admin.pages.edit', compact('page', 'categories', 'fields', 'formats'));
    }

    public function update($id, Request $request) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $page = Page::withTrashed()->find($id);
        $this->validate(request(), [
            'name' => ['required', 'max:200'],
            'slug' => ['unique:pages,slug,'.$page->id, 'required', 'max:100']
        ]);
        //restore trashed item
        if($request->untrash) {
            $page->restore();
        }

        $page->category_id = $request->category_id;
        $page->name = $request->name;
        $page->slug = $request->slug;
        $page->picture = $request->picture;
        $page->description = $request->description;
        $page->content = $request->content;
        $page->weight = $request->weight;
        $page->save();

        flash('Record updated')->success();
        return redirect()->action('Admin\PageController@index');
    }
    public function destroy($id) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $page = Page::withTrashed()->find($id);
        if($page->trashed()) {
            $page->forceDelete();
        }
        Page::destroy($page->id);
        flash('Record deleted')->success();
        return redirect()->action('Admin\PageController@index');
    }
}
