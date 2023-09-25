<?php

namespace App\Http\Controllers;

use App\Models\BarCode;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\BarCode as ModelsBarCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class BarCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('backend.barcode.barcode',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BarCode $barCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarCode $barCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarCode $barCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarCode $barCode)
    {
        //
    }
    public function print()
    {
        $selectProducts = ModelsBarCode::all();



        $pdf = Pdf::loadView('backend.pdf.barcode_pdf', compact('selectProducts'));
        return $pdf->stream(Carbon::now()->timestamp.'_'.'invoice.pdf');
    }
}
