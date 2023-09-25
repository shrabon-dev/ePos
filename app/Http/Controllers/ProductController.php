<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Product;
use App\Models\Tax;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return View('backend.product.product',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $taxes = Tax::all();
        return view('backend.product.create_product',compact('categories','brands','taxes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            '*' => 'required',
        ]);

        $file = $request->file('image');
        $file->storeAs('public/product/',$request->file('image')->getClientOriginalName());

        Product::create($request->except('_token','image')+[
            'image' => $request->file('image')->getClientOriginalName(),
        ]);

        return redirect()->route('product.index')->with('status','Successfully created a new product');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $brands = Brand::all();
        return view('backend.product.edit_product',compact('product','categories','brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->file('image')){
            $file = $request->file('image');
            $file->storeAs('public/product/',$request->file('image')->getClientOriginalName());
            Product::find($id)->update($request->except('_token','image')+[
                'image' => $request->file('image')->getClientOriginalName(),
            ]);
        }else{
            Product::find($id)->update($request->except('_token','image'));
        }

        return redirect()->route('product.index')->with('status','Successfully updated a product');
    }
    /**
     * Product Sale Method.
     */
    public function sale(Request $request)
    {

            $request->validate([
                'total_paying_price' => 'required|numeric'
            ]);

            if($request->payment_system == 'cod'){
                if($request->total_payable - $request->total_paying_price == 0){
                  $invoiceId = Invoice::insertGetId([
                        "sale_by" => auth()->user()->id,
                        "payment_system" => $request->payment_system,
                        "payment_status" => 'completed',
                        "order_status" => 'completed',
                        "due" => $request->total_payable - $request->total_paying_price,
                        "sub_total" => $request->sub_total,
                        "total_discount" => $request->total_discount,
                        "total_tax" => $request->total_tax,
                        "paid" => $request->total_paying_price,
                        "total_price" => $request->total_payable,
                        'created_at' => Carbon::now(),
                        ]);
                        if($request->customer_id){
                            Invoice::find( $invoiceId)->update([
                                "customer_id" => $request->customer_id,
                            ]);
                        }
                }else{
                    $invoiceId = Invoice::insertGetId([

                        "payment_system" => $request->payment_system,
                        "payment_status" => 'incomplete',
                        "order_status" => 'completed',
                        "due" => $request->total_payable - $request->total_paying_price,
                        "sub_total" => $request->sub_total,
                        "total_discount" => $request->total_discount,
                        "total_tax" => $request->total_tax,
                        "total_price" => $request->total_payable,
                        "paid" => $request->total_paying_price,
                        "sale_by" => auth()->user()->id,
                        "created_at" => Carbon::now(),
                    ]);
                    if($request->customer_id){
                        Invoice::find( $invoiceId)->update([
                            "customer_id" => $request->customer_id,
                        ]);
                    }
                }
            }

            $carts = Cart::all();
            foreach($carts as $cart){
                InvoiceDetail::insert([
                    'product_id' => $cart->product_id,
                    'invoice_id' => $invoiceId,
                    'quantity' => $cart->quantity,
                    'unit_price' =>  Product::find($cart->product_id)->price,
                    'created_at' => Carbon::now(),
                ]);

                Cart::find($cart->id)->delete();
            }
        if ($request->save == 'save_print'){
            return redirect()->route('invoice.print',$invoiceId)->with('message','Congratulations!! you sale a new product')->with('print_show',true);
        } else{
            return back()->with('message','Congratulations!! you sale a new product');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::find($id)->delete();
        return back()->with('status','Successfully deleted a product');
    }
}

