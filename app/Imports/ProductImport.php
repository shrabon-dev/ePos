<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'name' =>  $row[0],
            'code' => $row[1],
            'category' => $row[2],
            'brand' => $row[3],
            'unit' => $row[4],
            'warehouse' => $row[5],
            'status' => $row[6],
            'description' => $row[7],
            'image' => $row[8],
            'sku' => $row[9],
            'barcode' => $row[10],
            'price' => $row[11],
            'discount_type' => $row[12],
            'discount' => $row[13],
            'tax' => $row[14],
            'quantity' => $row[15],
            'alert_quantity' => $row[16],
        ]);
    }
}
