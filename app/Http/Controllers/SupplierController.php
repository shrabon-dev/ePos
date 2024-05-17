<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('backend.supplier.index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'post_code' => 'required',
            'address' => 'required',
        ]);

        Supplier::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'gst_number' => $request->gst_number,
            'tax_number' => $request->tax_number,
            'country' => $request->country,
            'city' => $request->city,
            'state' => $request->state,
            'post_code' => $request->post_code,
            'address' => $request->address,
        ]);
        return back()->with('message','Successfully created a new supplier');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'post_code' => 'required',
            'address' => 'required',
        ]);

        $supplier->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'gst_number' => $request->gst_number,
            'tax_number' => $request->tax_number,
            'country' => $request->country,
            'city' => $request->city,
            'state' => $request->state,
            'post_code' => $request->post_code,
            'address' => $request->address,
        ]);

        return back()->with('message','Successfully created a new supplier');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return back()->with('delete','Successfully deleted a supplier');
    }
}
