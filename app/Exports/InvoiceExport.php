<?php

namespace App\Exports;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InvoiceExport implements FromView
{
    private $invoice_id;
    public function __construct($id)
    {
        $this->invoice_id = $id;
    }

    public function view(): View
    {
        $invoice = Invoice::find($this->invoice_id);
        $invoiceDetails = InvoiceDetail::where('invoice_id',$this->invoice_id)->get();

        return view('backend.pdf.download.invoice',compact('invoice','invoiceDetails'));
        // return view('backend.pdf.invoice');
    }
}
