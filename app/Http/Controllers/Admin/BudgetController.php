<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Budget;
use App\User;
use Auth;
use App\Http\Controllers\Controller;

class BudgetController extends Controller
{
  public function index() {
    if(!$this->hasrole('Admin')) { return redirect('/'); }
    $users = User::all();
  	$budgets = Budget::orderBy('updated_at', 'desc')->get();
  	return view('admin.budgets.index', compact('budgets', 'users'));
  }
  public function store(Request $request) {
    if(!$this->hasrole('Admin')) { return redirect('/'); }
	  $this->validate(request(), [
      'user_id' => ['required'],
      'budget' => ['required'],
      'description' => ['required']
    ]);

    $user = User::find($request->user_id);
    $user->budget += $request->budget;
    $user->save();

    $budget = new Budget;
    $budget->user_id = $request->user_id;
    $budget->user_by = Auth::user()->name.'-'.Auth::user()->id;
    $budget->budget = $request->budget;
    $budget->description = $request->description;
    $budget->save();
    flash('Record created')->success();
    return redirect()->action('Admin\BudgetController@index');
  }

}
