<?php

namespace App\Exports;

use App\Invoice;
use App\Models\BarCode as ModelsBarCode;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BarcodeExport implements FromView
{
    public function view(): View
    {
        $selectProducts = ModelsBarCode::all();
        return view('backend.pdf.barcode_pdf',compact('selectProducts'));
    }
}
