<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Block;
use App\Http\Controllers\Controller;

class BlockController extends Controller
{
    public function index()
    {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
    	$blocks = Block::orderBy('updated_at', 'desc')->get();
    	return view('admin.blocks.index', compact('blocks'));
    }
    public function store(Request $request) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
    	$this->validate(request(), [
            'name' => ['required', 'max:100']
        ]);

        $block = new Block;
        $block->name = $request->name;
        $block->format = $request->format;
        $block->save();
        flash('Record created')->success();
        return redirect()->action('Admin\BlockController@index');

    }

    public function edit($id) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $block = Block::find($id);
        return view('admin.blocks.edit', compact('block'));
    }

    public function update($id, Request $request) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }

        $block = Block::find($id);

        $this->validate(request(), [
            'name' => ['required', 'max:100']
        ]);
        
        $block->name = $request->name;
        $block->format = $request->format;
        $block->picture = $request->picture;
        $block->description = $request->description;
        $block->content = $request->content;
        $block->weight = $request->weight;
        $block->link = $request->link;
        $block->style = $request->style;
        $block->save();

        flash('Record updated')->success();
        return redirect()->action('Admin\BlockController@index');
    }
    public function destroy($id) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $block = Block::find($id);
        Block::destroy($block->id);
        flash('Record deleted')->success();
        return redirect()->action('Admin\BlockController@index');
    }
}
