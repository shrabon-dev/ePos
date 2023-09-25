<?php

namespace App\Http\Livewire;

use App\Exports\BarcodeExport;
use App\Models\BarCode as ModelsBarCode;
use App\Models\Product;
use Illuminate\Console\View\Components\Alert;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;


class Barcode extends Component
{
    public $barCodeProduct = array();
    public $selectProduct;
    public $justProduct = 0;
    // public $selectedValues = [1];
    public $color_dropdown;
    public $quantityAction = [];
    public $updateQuantity;
    public $search;
    public $p_id;
    public $generateProduct = false;

    public function selectProduct($id){
        if(!ModelsBarCode::where('product_id',$id)->exists()){
            ModelsBarCode::create([
                'product_id' => $id,
                'quantity' => '1',
            ]);
        }
    }

    public function removeSelectProduct($id){
        ModelsBarCode::find($id)->delete();
    }

    public function exportProduct(){
        $this->generateProduct = true;
    }

    public function updateQuantity($id){
        $barcode = ModelsBarCode::find($id);

        if(isset($this->quantityAction[$id])){
            if( $this->quantityAction[$id] > 0){
                if ($barcode) {
                    $barcode->quantity = $this->quantityAction[$id];
                    $barcode->save();
                }
            }
        }

        // $this->p_id =  $this->quantityAction[$id];
        // ModelsBarCode::find($id)->increment($this->quantityAction);
    }
    public function render()
    {
        $products = Product::where('name','like','%'. $this->search . '%')->orWhere('barcode','like','%'.$this->search.'%')->get();
        $selectProducts = ModelsBarCode::all();
        return view('livewire.barcode',compact('products','selectProducts'));
    }
}
