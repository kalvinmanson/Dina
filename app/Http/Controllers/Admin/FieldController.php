<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Field;
use App\Category;
use App\Page;
use App\Http\Controllers\Controller;

class FieldController extends Controller
{
    public function index() {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        // Only Admins
        $fields = Field::select('name')->groupBy('name')->get();
        return response()->json($fields);
    }
    public function store(Request $request) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
    	$this->validate(request(), [
            'name' => ['required', 'max:100']
        ]);

        $field = new Field;

        $field->page_id = $request->page_id;
        $field->category_id = $request->category_id;
        $field->name = $request->name;
        $field->format = $request->format;
        $field->content = $request->content;
        $field->save();
        flash('Record created')->success();
        if($field->page) {
            return redirect()->action('Admin\PageController@edit', $field->page_id);
        } elseif($field->category) {
            return redirect()->action('Admin\CategoryController@edit', $field->category_id);
        }


    }

    public function edit($id) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $field = Field::find($id);
        $formats = Field::select('format')->groupBy('format')->get();
        return view('admin.fields.edit', compact('field', 'formats'));
    }

    public function update($id, Request $request) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $field = Field::find($id);

        $field->format = $request->format;
        $field->content = $request->content;
        $field->save();

        flash('Record updated')->success();
        if($field->page) {
            return redirect()->action('Admin\PageController@edit', $field->page_id);
        } elseif($field->category) {
            return redirect()->action('Admin\CategoryController@edit', $field->category_id);
        }
    }
    public function destroy($id) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $field = Field::find($id);
        Field::destroy($field->id);
        flash('Record deleted')->success();
        if($field->page) {
            return redirect()->action('Admin\PageController@edit', $field->page_id);
        } elseif($field->category) {
            return redirect()->action('Admin\CategoryController@edit', $field->category_id);
        }
    }
}
