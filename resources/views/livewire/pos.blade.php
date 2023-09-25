<div>
    <style>
        .btn:focus,.form-control:focus,.fcs:focus {
            outline: none;
            box-shadow: none;
        }
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button{
            appearance: none;
            -webkit-appearance: none;
            margin: 0;
        }

.js_modal{
    width: 100vw;
    height: 100vh;
    background: #00000054;
    position: fixed;
    top: 0;
    left: 0;
    content: '';
    z-index: 99999;
    display: none;
    animation: opacity .2s linear;
    -webkit-animation: opacity .2s linear;
}
.js_content{
    background: #ffffff;
    min-width: 600px;
    max-width: 600px;
    min-height: auto;
    max-height: 650px;
    color: #000000;
    border-radius: 10px;
    box-shadow: 0 0 15px 0 #000000;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    -ms-border-radius: 10px;
    -o-border-radius: 10px;
    position: absolute;
    top: 50px;
    left: 50%;
    transform: translate(-50%,-0);
    -webkit-transform: translate(-50%,-0);
    -moz-transform: translate(-50%,-0);
    -ms-transform: translate(-50%,-0);
    -o-transform: translate(-50%,-0);
    animation: smooth .2s linear;
    -webkit-animation: smooth .2s linear;
    opacity: 1;
    transition: .2s all ease-in-out;
    -webkit-transition: .5s all ease-in-out;
    -moz-transition: .5s all ease-in-out;
    -ms-transition: .5s all ease-in-out;
    -o-transition: .5s all ease-in-out;

}
@keyframes smooth {
    0%{
        top: -100%;
        transform: translate(-50%,-25px);
        -webkit-transform: translate(-50%,-25px);
        -moz-transform: translate(-50%,-25px);
        -ms-transform: translate(-50%,-25px);
        -o-transform: translate(-50%,-25px);
        opacity: 0;
    }

    100%{
        top: 50px;
        transform: translate(-50%,-0);
        -webkit-transform: translate(-50%,-0);
        -moz-transform: translate(-50%,-0);
        -ms-transform: translate(-50%,-0);
        -o-transform: translate(-50%,-0);
        opacity: 1;
    }
}
@keyframes opacity {
    0%{

        opacity: 0;
    }

    100%{

        opacity: 1;
    }
}

.js_modal_body{
    padding: 20px;
}
.js_modal_footer{
    border-top: 1px solid #797878fb;
    padding: 10px;
    display: flex;
    justify-content: end;
    align-items: center;
}
.close_btn{
    display: inline-block;
    padding: 6px 20px;
    background: #e6e6e6;
    border: 1px solid #7e7e7e;
    border-radius: 5px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    -ms-border-radius: 5px;
    -o-border-radius: 5px;
    cursor: pointer;
    transition: .4s all ease-in-out;
    -webkit-transition: .4s all ease-in-out;
    -moz-transition: .4s all ease-in-out;
    -ms-transition: .4s all ease-in-out;
    -o-transition: .4s all ease-in-out;
}
    </style>
    <div class="row">
        <div class="col-md-9">
            <div class="card p-3">
                <div class="row">
                    <div class="col-6">
                        <h3 class="pb-2"><i class="fadeIn animated bx bx-cart-alt text-primary"></i> Sales invoice</h3>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn inline-block btn-primary">Add Customer</button>
                        </div>
                        <!-- Add user modal form start -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore>
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create Customer</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form wire:submit.prevent="add_customer">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input wire:model="name" class="form-control" id="name" aria-describedby="helpId" placeholder="">
                                            </div>
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone Number</label>
                                                <input wire:model="phone" type="number" class="form-control" id="phone" aria-describedby="helpId" placeholder="">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input wire:model="email" type="text" class="form-control" id="email" aria-describedby="helpId" placeholder="">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Role</label>
                                                <select wire:model="role" name="role" id="" class="form-control">
                                                    @foreach ($roles as $role)
                                                    @if ($role->name !== 'super-admin')
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Add Customer</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Add user modal form end -->
                    </div>
                </div>
                {{--  --}}
                {{-- user searc input & Product name input start--}}
                <div class="row">
                    <div class="col-6">
                        <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon1">
                            <div class="text-primary">
                                <i class="fadeIn animated bx bx-user"></i>
                            </div>
                        </span>
                            <input wire:model="name_phone_number" id="name_phone_number" type="text" class="form-control" placeholder="Name/Phone number" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div style="position: absolute;width:100%">
                            @if ($users)
                                @foreach ($users as $customer)
                                <button wire:click="selectUser({{ $customer->id }})" type="button" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                                    <span class="d-flex align-items-center justify-content-between gap-3">
                                        <span>
                                            {{-- <img style="width: 60px;height:40px;display:block" src="{{ asset('storage/product') }}/{{ $product->image }}" alt=""> --}}
                                        </span>
                                        <span>
                                            {{ $customer->name }}
                                        </span>
                                    </span>
                                </button>
                                @endforeach
                            @endif
                            </div>
                    </div>
                    <div class="col-6" style="position: relative">
                        <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon1"><div class="text-primary"><i class="fadeIn animated bx bx-barcode"></i></div></span>
                            <input wire:model="product_barcode" id="product_barcode" type="text" class="form-control" placeholder="Product/Barcode" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div style="position: absolute;width:100%">
                        @if ($products)
                            @foreach ($products as $product)
                            <button wire:click="selectProduct({{ $product->id }})" type="button" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                                <span class="d-flex align-items-center justify-content-between gap-3">
                                    <span>
                                        <img style="width: 60px;height:40px;display:block" src="{{ asset('storage/product') }}/{{ $product->image }}" alt="">
                                    </span>
                                    <span>
                                        {{ $product->name }}
                                    </span>
                                </span>
                            </button>
                            @endforeach
                        @endif
                        </div>

                    </div>
                </div>
                {{-- user searc input & Product name input end--}}
                {{-- Item List Start --}}
                <div class="border p-3">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead style="background: #2869e4; color: #ffffff">
                                <tr>
                                    <th>SL. </th>
                                    <th>Product</th>

                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Tax</th>
                                    <th>Sub Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- Custome PHP Code for take Variable --}}
                                @php
                                    $price = 0;
                                    $totalPrice = 0;
                                    $totalDiscount = 0;
                                    $totalTax = 0;
                                @endphp
                                {{-- Custome PHP Code for take Variable --}}

                                @forelse ($carts as $cart)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="ms-2">
                                                    <h6 class="mb-0 font-14">{{ $loop->index + 1 }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="ms-2">
                                                    <h6 class="mb-0 font-14">{{ $cart->relationWithProduct->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>

                                            <div class="d-flex">
                                                @if ($cart->quantity > 1)
                                                    <button wire:click="decrement({{ $cart->id }})" style="height: 30px !important;line-height: 0 !important;font-size: 30px;" class="btn" data-action="minus" type="button">-</button>
                                                @else
                                                    <button style="height: 30px !important;line-height: 0 !important;font-size: 30px; opacity:.5" class="btn" data-action="minus" type="button">-</button>
                                                @endif
                                                <input style="width: 60px !important;height:30px !important;" class="form-control" type="number" name="product-qty" value="{{ $cart->quantity }}">
                                                <button wire:click="increment({{ $cart->id }})" style="    height: 30px !important;line-height: 0 !important; font-size: 20px;" class="btn" data-action="add" type="button">+</button>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $cart->relationWithProduct->price * $cart->quantity }}
                                            @php
                                                $price += $cart->relationWithProduct->price * $cart->quantity
                                            @endphp
                                        </td>

                                        <td>
                                           @if ($cart->relationWithProduct->discount_type == 'fixed')
                                            {{ $cart->relationWithProduct->discount * $cart->quantity }}
                                            @php
                                            $totalDiscount += $cart->relationWithProduct->discount * $cart->quantity
                                            @endphp
                                           @else
                                            {{ ceil(($cart->relationWithProduct->price * $cart->quantity)*$cart->relationWithProduct->discount/100) }}
                                            @php
                                            $totalDiscount += ceil(($cart->relationWithProduct->price * $cart->quantity)*$cart->relationWithProduct->discount/100)
                                            @endphp
                                           @endif
                                           <a href="#"><i class="fadeIn animated bx bx-edit-alt"></i></a>

                                        </td>
                                        <td>
                                            @if ($cart->relationWithProduct->discount_type == 'fixed')

                                            {{ (( $cart->relationWithProduct->price * $cart->quantity) - ($cart->relationWithProduct->discount * $cart->quantity)) * $cart->relationWithProduct->relationWithTax->percentage / 100 }}

                                            @php
                                                $totalTax += (( $cart->relationWithProduct->price * $cart->quantity) - ($cart->relationWithProduct->discount * $cart->quantity)) * $cart->relationWithProduct->relationWithTax->percentage / 100
                                            @endphp
                                            @else

                                            {{ (( $cart->relationWithProduct->price * $cart->quantity) - ( ($cart->relationWithProduct->price * $cart->quantity) * $cart->relationWithProduct->discount/100)) * $cart->relationWithProduct->relationWithTax->percentage / 100 }}
                                            @php
                                            $totalTax += (( $cart->relationWithProduct->price * $cart->quantity) - ceil(($cart->relationWithProduct->price * $cart->quantity))*$cart->relationWithProduct->discount/100) * $cart->relationWithProduct->relationWithTax->percentage / 100
                                            @endphp
                                            @endif
                                           <a href="#"><i class="fadeIn animated bx bx-edit-alt"></i></a>
                                        </td>
                                        <td>
                                            @if ($cart->relationWithProduct->discount_type == 'fixed')

                                            {{  ((( $cart->relationWithProduct->price * $cart->quantity) - $cart->relationWithProduct->discount * $cart->quantity)) + ((( $cart->relationWithProduct->price * $cart->quantity) - $cart->relationWithProduct->discount * $cart->quantity) * $cart->relationWithProduct->relationWithTax->percentage / 100) }}
                                            @php
                                                $totalPrice += ((( $cart->relationWithProduct->price * $cart->quantity) - $cart->relationWithProduct->discount * $cart->quantity)) + ((( $cart->relationWithProduct->price * $cart->quantity) - $cart->relationWithProduct->discount * $cart->quantity) * $cart->relationWithProduct->relationWithTax->percentage / 100)
                                            @endphp
                                           @else

                                           {{ ((( $cart->relationWithProduct->price * $cart->quantity) - ceil(($cart->relationWithProduct->price * $cart->quantity))*$cart->relationWithProduct->discount/100)) + ((( $cart->relationWithProduct->price * $cart->quantity) - ceil(($cart->relationWithProduct->price * $cart->quantity))*$cart->relationWithProduct->discount/100) * $cart->relationWithProduct->relationWithTax->percentage / 100) }}

                                           @php
                                               $totalPrice += ((( $cart->relationWithProduct->price * $cart->quantity) - ceil(($cart->relationWithProduct->price * $cart->quantity))*$cart->relationWithProduct->discount/100)) + ((( $cart->relationWithProduct->price * $cart->quantity) - ceil(($cart->relationWithProduct->price * $cart->quantity))*$cart->relationWithProduct->discount/100) * $cart->relationWithProduct->relationWithTax->percentage / 100)
                                           @endphp
                                           @endif
                                        </td>
                                        <td>
                                            <div  class="d-flex text-danger">
                                                <a href="javascript:;" class="ms-3"><i wire:click="cart_delete({{ $cart->id }})" class="bx bxs-trash text-danger"></i></a>
                                            </div>

                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-danger text-center" colspan="8">Empty Cart</td>
                                    </tr>
                                    @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
                {{-- Item List End --}}
            </div>
        </div>
        <div class="col-md-3" >
            <div class="card p-3" >
                <div class="card border-top border-0 border-4 border-info" style="height: 700px">
                    <div class="card-body">
                        <div class="">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxs-user me-1 font-22 text-info"></i>
                                </div>
                                <h5 class="mb-0 text-info">Invoice</h5>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <label for="inputEnterYourName" class="col-6">Price</label>
                                <div class="col-6">
                                    <input type="text" readonly class="inline-block fcs" style="border: none;display:inline-block;width:70px" value="{{ $price }}"><span>TK.</span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEnterYourName" class="col-6">Total Discount</label>
                                <div class="col-6">
                                    <input type="text" readonly class="inline-block fcs" style="border: none;display:inline-block;width:70px" value="{{ $totalDiscount }}"><span>TK.</span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEnterYourName" class="col-6">Total Tax</label>
                                <div class="col-6">
                                    <input type="text" readonly class="inline-block fcs" style="border: none;display:inline-block;width:70px" value="{{ $totalTax }}"><span>TK.</span>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <label for="inputEnterYourName" class="col-6">Total Price</label>
                                <div class="col-6">
                                    <input type="text" readonly class="inline-block fcs" style="border: none;display:inline-block;width:70px" value="{{ $totalPrice }}"><span>TK.</span>
                                </div>
                            </div>
                            <div class="row flex-wrap align-content-end align-items-end" >
                                <div class="col-6">
                                    <button type="submit" class="btn btn-danger w-100 mb-2 d-block"><i class="lni lni-hand"></i> Hold</button>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary w-100 mb-2 d-block"><i class="lni lni-credit-cards text-white"></i>Multiple</button>
                                </div>
                                <div class="col-6">
                                    <button type="submit" name="cash" class="btn btn-info w-100 d-block expose_btn"> <i class="fadeIn animated bx bx-money"></i> Cash</button>
                                    {{-- <button type="submit" class="btn btn-info w-100 d-block" data-bs-toggle="modal" data-bs-target="#cashModal"> <i class="fadeIn animated bx bx-money"></i> Cash</button> --}}
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-warning w-100 d-block"> <i class="fadeIn animated bx bx-money"></i> Pay All</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button trigger modal -->
            {{-- Payment Modal Start --}}
            @if ($openModal)
            <div class="js_modal" id="ownModal">
               <div class="js_content">
                <div class="js_modal_body">
                   @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert"><p>{{ $error }}</p></div>
                    @endforeach
                   @endif
                    <form action="{{ route('sale') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class=" px-2">
                                        <div class="card-title d-flex align-items-center">
                                            <div><i class="bx bxs-user me-1 font-22 text-info"></i>
                                            </div>
                                            <h5 class="mb-0 text-info">Invoice {{ $customer_id }}</h5>
                                        </div>
                                        <hr>
                                        <input type="text" name="customer_id" value="{{ $customer_id }}" hidden>
                                        <div class="row mb-3">
                                            <label for="inputEnterYourName" class="col-6">Price</label>
                                            <div class="col-6">
                                                <input type="text" readonly name="sub_total" class="inline-block fcs" style="border: none;display:inline-block;width:70px" value="{{ $price }}"><span>TK.</span>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputEnterYourName" class="col-6">Total Discount</label>
                                            <div class="col-6">
                                                <input type="text" readonly name="total_discount" class="inline-block fcs" style="border: none;display:inline-block;width:70px" value="{{ $totalDiscount }}"><span>TK.</span>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputEnterYourName" class="col-6">Total Tax</label>
                                            <div class="col-6">
                                                <input type="text" readonly name="total_tax" class="inline-block fcs" style="border: none;display:inline-block;width:70px" value="{{ $totalTax }}"><span>TK.</span>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputEnterYourName text-white" class="col-6">Payment System:</label>
                                            <div class="col-6">
                                                <select name="payment_system" id="" class="inline-block form-select fcs" style="border: none;">
                                                    <option value="cod">Cash On Delivery</option>
                                                    <option value="online">Online Pay</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row py-2 mt-2" style="box-shadow:0 0 5px 0 #21212144;border-radius:10px;background:rgb(255, 187, 1)">
                                            <label for="inputEnterYourName text-white" class="col-6">Total Payable:</label>
                                            <div class="col-6">
                                                <input type="text" readonly name="total_payable" class="inline-block fcs" style="border: none;display:inline-block;width:70px;background:rgb(255, 187, 1)" value="{{ $totalPrice }}"><span>TK.</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row py-2 mt-2" style="box-shadow:0 0 5px 0 #21212144;border-radius:10px">
                                            <label for="inputEnterYourName" class="col-6">Total Paying:</label>
                                            <div class="col-6">
                                                <input type="text" name="total_paying_price" class="inline-block fcs" style="border: 1px solid #c9c9c9;display:inline-block;width:90px" value=""><span> TK.</span>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="js_modal_footer">
                            <button type="button" class="btn btn-primary close_btn m-2" style="background: red !important;border:none">Close</button>
                            <button type="submit" name="save" value="save" class="btn btn-primary m-2">Save</button>
                            <button type="submit" name="save" value="save_print" class="btn btn-warning m-2">Save & <i class="fadeIn animated bx bx-printer"></i> Print</button>
                        </div>
                    </form>
                </div>
               </div>
            </div>
            @endif
            {{-- Payment Modal End --}}

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded',function (){
            const exposeBtn = document.querySelector(".expose_btn");
            const modal = document.querySelector(".js_modal");
            const closeBtn = document.querySelector(".close_btn");

            exposeBtn.addEventListener('click',function (){
                modal.style.display = "block"
            })
            closeBtn.addEventListener('click',function (){
                modal.style.display = "none"
            })


        })
    </script>
</div>
