<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contact;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
    	$contacts = Contact::all();
    	return view('admin.contacts.index', compact('contacts'));
    }

    public function edit($id) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $contact = Contact::find($id);
        return view('admin.contacts.edit', compact('contact'));
    }

    public function update($id, Request $request) {
        if(!$this->hasrole('Admin')) { return redirect('/'); }
        $contact = Contact::find($id);
        $this->validate(request(), [
            'name' => ['required', 'max:100']
        ]);        
        $contact->name = $request->name;
        $contact->role = $request->role;

        $contact->save();
        flash('Record updated')->success();
        return redirect()->action('Admin\ContactController@index');
    }
}
