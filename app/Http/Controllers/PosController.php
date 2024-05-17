<?php

namespace App\Http\Controllers;

use App\Exports\InvoiceExport;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PosController extends Controller
{
    public function invoicePrint($id){
        $invoice = Invoice::find($id);
        $invoiceDetails = InvoiceDetail::where('invoice_id',$id)->get();

        return view('backend.pdf.invoice',compact('invoice','invoiceDetails'));
    }

    public function export($id){

        $invoice = Invoice::find($id);
        $invoiceDetails = InvoiceDetail::where('invoice_id',$id)->get();

        $pdf = Pdf::loadView('backend.pdf.download.invoice',compact('invoice','invoiceDetails'))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download(Carbon::now()->timestamp.'_'.'invoice.pdf');
    }

    public function print($id){

        $invoice = Invoice::find($id);
        $invoiceDetails = InvoiceDetail::where('invoice_id',$id)->get();

        $pdf = Pdf::loadView('backend.pdf.download.invoice',compact('invoice','invoiceDetails'))->setOptions(['defaultFont' => 'sans-serif','isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        return $pdf->stream(Carbon::now()->timestamp.'_'.'invoice.pdf');
    }

    public function invoice_update(Request $request,$id){
        if($request->total_price - ($request->now_paying + $request->total_payment) == 0||$request->total_price - ($request->now_paying + $request->total_payment) < 0){
            Invoice::find($id)->update([
                'paid' => $request->now_paying + $request->total_payment,
                'due' => $request->total_price - ($request->now_paying + $request->total_payment),
                'payment_status' => 'completed',
            ]);
        }else{
            Invoice::find($id)->update([
                'paid' => $request->now_paying + $request->total_payment,
                'due' => $request->total_price - ($request->now_paying + $request->total_payment),
            ]);
        }
        return back()->with('updated','Successfully updated invoice');

    }
    public function invoice_view($id){

        $invoice = Invoice::find($id);
        $invoiceDetails = InvoiceDetail::where('invoice_id',$id)->get();

        return view('backend.pdf.invoice',compact('invoice','invoiceDetails'));
    }
    public function invoice_delete($id){

        Invoice::find($id)->delete();

        return back()->with('delete','Successfully deleted invoice');
    }

}
