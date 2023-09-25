<?php

use App\Models\Invoice;

    function salesCount(){
        $Sales = Invoice::all();
        return  $Sales;
    }

?>
