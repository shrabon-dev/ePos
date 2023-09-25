<div>
<style>
    /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
:focus{
    outline: none;
}
/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Forms</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Barcode Generate & Lists</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
             @foreach ($errors->all() as $error)
             <div class="alert alert-danger" role="alert">
                <strong>{{ $error }}</strong>
             </div>
             @endforeach
            @endif
            <div class="p-4 border rounded">

                    {{-- @csrf --}}
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Product Search</label>
                        <input wire:model="search" type="text" class="form-control" id="validationCustom01" name="name" placeholder="name here..." required="">



                        <!-- Hover added -->
                        <div class="list-group mt-5" style="min-height:100px;max-height: 150px;overflow-y:scroll">
                            @if ($search)
                                @forelse ($products as $product)
                                <button wire:click="selectProduct({{ $product->id }})" type="button" class="list-group-item list-group-item-action d-flex align-items-center justify-content-between">
                                    <span class="d-flex align-items-center justify-content-between gap-3">
                                        <span>
                                            <img style="width: 60px;height:40px;display:block" src="{{ asset('storage/product') }}/{{ $product->image }}" alt="">
                                        </span>
                                        <span>
                                            {{ $product->name }}
                                        </span>
                                    </span>
                                    <span>
                                        {{ $product->barcode }}
                                    </span>
                                </button>
                                @empty
                                <h1 style="font-size: 24px;text-align:center;color:#949494;padding-top:30px">No Search Velue</h1>
                                @endforelse
                            @else
                                <h1 style="font-size: 24px;text-align:center;color:#949494;padding-top:30px">No Search Velue</h1>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 mt-5">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Product Id {{ $p_id }}</th>
                                        <th>Image</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($selectProducts as $product)
                                        <tr>
                                            <td>#{{ $product->id }}</td>
                                            <td>
                                                <span>
                                                    <img style="width: 60px;height:40px;display:block" src="{{ asset('storage/product') }}/{{ $product->realtionWithProduct->image }}" alt="">
                                                </span>
                                            </td>
                                            <td>{{ $product->realtionWithProduct->name }}</td>
                                            <td>
                                                <label for="quantity" class="badge bg-primary ">{{ $product->quantity}}</label>
                                                <input style="border:none;border-bottom:1px solid #171717;padding-left:6px;margin-left:15px;width:100px;background:#cfcfcf"  wire:model="quantityAction.{{ $product->id }}" id="quantity" wire:keydown.debounce.100ms="updateQuantity({{ $product->id }})" type="number">
                                            </td>
                                            <td>
                                                <div class="">
                                                    <a wire:click='removeSelectProduct({{ $product->id }})' class="sm-btn p-2 rounded btn-danger cursor-pointer">Remove</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <h1 style="font-size: 38px;color:rgb(175, 175, 175);text-align:center;">No Select Any Product</h1>
                                    @endforelse

                                </tbody>
                            </table>

                            {{-- Barcode Generate Button Start --}}
                            <div class="d-grid gap-2 mt-5">
                              <button wire:click="exportProduct()" type="submit" name="" id="" class="btn btn-primary">Generate Barcode</button>
                            </div>
                            {{-- Barcode Generate Button End --}}
                        </div>
                    </div>

            </div>
        </div>
    </div>
    @if ($generateProduct)
    <h6 class="mb-0 text-uppercase">Barcode List</h6>
    <div class="col-8 m-auto shadow p-3">
        <div class="d-flex flex-wrap gap-5">
            @php
                $arr = array();
                foreach ($selectProducts as $key => $product) {
                    array_push($arr, $product->realtionWithProduct->barcode);
                };
            @endphp
            @foreach ($selectProducts as $product)
            @for ($i = 0; $i < $product->quantity; $i++)
            <div class="border text-center inline-block p-3" style="width:300px;">
                <p>Product: {{ $product->realtionWithProduct->name }} </p>
                <p>Code: {{ $product->realtionWithProduct->code }} </p>
                <span style="font-size: 10px !important">
                    {!! DNS1D::getBarcodeHTML($arr[$loop->index], 'C39+') !!}
                </span>
            </div>
            @endfor
            @endforeach
        </div>
    </div>
    <div class="text-end  d-block">
       <a href="{{ route('barcode.print') }}" class="btn btn-primary" >
           <i class="fadeIn animated bx bx-printer"></i>
        </a>
       {{-- <button wire:click="exportProduct()" class="btn btn-primary" >
           <i class="fadeIn animated bx bx-printer"></i>
        </button> --}}
    </div>
    @endif
    <hr>
    <script>
        $(document).ready(function () {
            $('.js-example-basic-single').select2();

            // Listen for select change event
            $('#selectProduct').on('change', function (e) {
                Livewire.emit('updatedJustProduct', e.target.value);
            });
        });
    </script>
</div>

