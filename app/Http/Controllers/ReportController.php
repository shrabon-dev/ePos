<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Product;
use App\Models\Salary;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    function productReport(Request $request){
        $products = Product::all();

        if($request->name_of_product || $request->brand_of_product || $request->category_of_product){
            $products = Product::where('name', 'LIKE', "%$request->name_of_product%")
            ->where('brand', 'LIKE', "%$request->brand_of_product%")
            ->where('category', 'LIKE', "%$request->category_of_product%")
            ->get();
        }
        $totalSales = InvoiceDetail::all();
        $productName = Product::all();
        $brands = Brand::all();
        $category = Category::all();

        return view('backend.report.product',compact('products','brands','productName','category','totalSales'));
    }
    function salaryReport(){

        return view('backend.report.salary');
    }
    function saleReport(Request $request){
        $filteredSales = Invoice::all();


        // Apply filters if they are provided in the request
        if ($request->customer || $request->payment_status) {
            // Start with the base query to fetch all sales
            $sales = Invoice::query();

            $startDate = Carbon::parse($request->from_date);
            $toDate = Carbon::parse($request->to_date);
            $sales->where('customer_id', 'LIKE', "%$request->customer%")->where('payment_status', 'LIKE', "%$request->payment_status%");

            if($request->filled('from_date') || $request->filled('to_date')){
                $sales->whereBetween('created_at', [$startDate, $toDate])->where('customer_id', 'LIKE', "%$request->customer%")->where('payment_status', 'LIKE', "%$request->payment_status%");
            }

            $filteredSales = $sales->get();
        }

        $customers =  User::role('customer')->get();
        return view('backend.report.sale',compact('filteredSales','customers'));
    }

}
