<?php

use App\Models\Employe;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

    function salesCount(){
        $Sales = Invoice::all();
        return  $Sales;
    }
    function employeCount(){
        $employes = Employe::all()->count();
        return  $employes;
    }
    function totalProduct(){
        return DB::table('products')->get();
    }
    function totalEmploye(){
        return DB::table('employes')->get();
    }
    function totalSell(){
        return DB::table('invoice_details')->get();
    }

?>
