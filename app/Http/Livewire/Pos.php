<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Pos extends Component
{
    public $name;
    public $phone;
    public $email;
    public $role;
    public $name_phone_number;
    public $product_barcode;
    public $selectProduct;
    public $selectUser;
    public $customer_id;
    public $users;
    public $cartID;
    public $price;
    public $totalDiscount;
    public $totalTax;
    public $totalPrice;
    public $amount;
    public $totalPaying;
    public $description;
    public $total_paying;
    public $openModal = true;


    public function add_customer()
    {
        $random_password = Str::random(8);

        $userID = User::insertGetId([
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => Carbon::now(),
            'account_status' => 'active',
            'password' => Hash::make($random_password),
        ]);

        User::find($userID)->assignRole($this->role);
        return back()->with('status','Successfully added a new user');
    }

    public function selectProduct($id){

        $customer = User::orderBy('created_at', 'asc')->first();
        $this->customer_id = $customer->id;

        $cartItem = Cart::where('product_id', $id)->where('customer_id', $customer->id)->exists();

        if($cartItem){
            Cart::where('product_id', $id)->where('customer_id', $customer->id)->increment('quantity');
        }else{
               Cart::insertGetId([
                'customer_id' => $customer->id,
                'product_id' => $id,
                'quantity' => 1,
            ]);
        }
        $this->product_barcode = '';

    }

    public function cart_delete($id){

        Cart::find($id)->delete();

    }
    public function increment($id) {
        Cart::find($id)->increment('quantity');
    }

    public function decrement($id) {
        Cart::find($id)->decrement('quantity');
    }
    public function sessionRemove(){

    }
    public function selectUser($id){

        $this->customer_id = $id;
        $this->users = '';
        $this->name_phone_number = '';
    }
    public function render()
    {

        $this->totalPaying = $this->amount;

        $products = '';

        if($this->product_barcode){
            $products = Product::where('name','like','%'.$this->product_barcode.'%')->orWhere('barcode','like','%'.$this->product_barcode.'%')->get();
        }
        if($this->name_phone_number){
            $this->users = User::where('name','like','%'.$this->name_phone_number.'%')->orWhere('contact_number','like','%'.$this->name_phone_number.'%')->get();
        }
        $carts = Cart::all();
        $roles = Role::all();
        return view('livewire.pos',compact('roles','products','carts',));
    }
}
