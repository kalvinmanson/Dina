<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contract;
use App\Group;
use Carbon;
use App\Http\Controllers\Controller;

class ContractController extends Controller
{
    public function index() {
      Carbon::setLocale('es');
      if(!$this->hasrole('Admin')) { return redirect('/'); }
    	$contracts = Contract::orderBy('updated_at', 'desc')->get();
    	return view('admin.contracts.index', compact('contracts'));
    }
    public function store(Request $request) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
    	  $this->validate(request(), [
            'name' => ['required', 'max:100'],
            'number' => ['required', 'unique:contracts']
        ]);

        $contract = new Contract;
        $contract->group_id = Group::first()->id;
        $contract->name = $request->name;
        $contract->number = $request->number;
        $contract->save();

        flash('Record created')->success();
        return redirect()->action('Admin\ContractController@index');

    }

    public function show($id) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $contract = Contract::find($id);
        return view('admin.contracts.show', compact('contract'));
    }

    public function edit($id) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $contract = Contract::find($id);
        $groups = Group::all();
        return view('admin.contracts.edit', compact('contract', 'groups'));
    }

    public function update($id, Request $request) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $contract = Contract::find($id);
        $this->validate(request(), [
            'name' => ['required', 'max:200']
        ]);

        $contract->group_id = $request->group_id;
        $contract->name = $request->name;
        $contract->number = $request->number;
        $contract->description = $request->description;
        $contract->ammount = 0;
        $contract->save();

        flash('Record updated')->success();
        return redirect()->action('Admin\ContractController@index');
    }
    public function destroy($id) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $contract = Contract::find($id);
        if($contract->trashed()) {
            $contract->forceDelete();
        }
        Contract::destroy($contract->id);
        flash('Record deleted')->success();
        return redirect()->action('Admin\ContractController@index');
    }
}
