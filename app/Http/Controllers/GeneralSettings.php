<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;

class GeneralSettings extends Controller
{
    // Tax List showing method
    public function tax(){
        $taxs = Tax::all();
        return view('backend.settings.tax.tax',compact('taxs'));
    }
    public function tax_store(Request $request){
         $request->validate([
            '*' => 'required',
        ]);
        Tax::create($request->except('_token'));
        return back()->with('status','Successfully created a new Tax');
    }
}
