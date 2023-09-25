@extends('layouts.backendMaster')
@section('style_body')
@endsection
@section('backend_content')
<div class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">ePos</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

  <div class="card">
      <div class="card-body p-4">
          <h5 class="card-title">Add New Product</h5>
          <hr>
          @if ($errors->any())
          <div class="alert alert-danger" role="alert">
            <strong>Please, fill up all field</strong>
          </div>
          @endif
           <div class="form-body mt-4">
            <form action="{{ route('product.update',$product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
            <div class="row">
               <div class="col-lg-6">
               <div class="border border-3 p-4 rounded">
                  <div class="mb-3">
                    <label for="inputProductTitle" class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" id="inputProductTitle" value="{{ $product->name }}" placeholder="Enter product title">
                  </div>
                  <div class="mb-3">
                    <label for="inputProductTitle" class="form-label">Product Code</label>
                    <input type="text" name="code" class="form-control" id="inputProductTitle" value="{{ $product->code }}" placeholder="Enter product title">
                  </div>
                  <div class="mb-3">
                    <label for="inputProductType" class="form-label">Category</label>
                    <select name="category" class="form-select" id="inputProductType">
                        <option value="" disabled selected>Choose a category</option>
                        @foreach ($categories as $category)
                          <option  {{ $product->category == $category->id ? 'selected':'' }} value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="mb-3">
                    <label for="inputProductType" class="form-label">Brand</label>
                    <select name="brand" class="form-select" id="inputProductType">
                            <option value="" disabled selected>Choose a brand</option>
                        @foreach ($brands as $brand)
                          <option {{ $product->brand == $brand->id ? 'selected':'' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                      </select>
                  </div>
                    <div class="mb-3">
                        <label for="inputProductType" class="form-label">Warehouse</label>
                        <select name="warehouse" class="form-select" id="inputProductType">
                            <option {{ $product->warehouse == 'Sherpur-Tawon'? 'selected':''  }} value="Sherpur-Tawon">Sherpur-Tawon</option>
                            <option {{ $product->warehouse == 'Sherpur-Kharom Pur'? 'selected':''  }} value="Sherpur - Kharom Pur">Sherpur - Kharom Pur</option>
                        </select>
                    </div>
                  <div class="mb-3">
                    <label for="inputProductType" class="form-label">Status</label>
                    <select name="status" class="form-select" id="inputProductType">
                        <option {{ $product->status == 'active'? 'selected':''  }} value="active">Active</option>
                        <option {{ $product->status == 'deactive'? 'selected':''  }} value="deactive">Deactive</option>
                    </select>
                  </div>


                  <div class="mb-3">
                    <label for="inputProductDescription" class="form-label">Description</label>
                    <textarea name="description" class="form-control" id="inputProductDescription" rows="3">{{ $product->description }}</textarea>
                  </div>
                  <div class="">
                    <label for="inputProductDescription" class="form-label">Product Images</label>
                    <input name="image" type="file"  >
                    <div style="width: 160px">
                        <img style="width: 100%" src="{{ asset('storage/product') }}/{{ $product->image }}" alt="">
                    </div>
                </div>
                </div>
               </div>
               <div class="col-lg-6">
                <div class="border border-3 p-4 rounded">
                  <div class="row g-3">
                    <div class="col-md-12">
                        <label for="inputProductType" class="form-label">Unit</label>
                        <select name="unit" class="form-select" id="inputProductType">
                            <option {{ $product->unit == 'pc'? 'selected':''  }} value="pc">PC</option>
                            <option {{ $product->unit == 'kg'? 'selected':''  }} value="kg">KG</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="inputProductTitle" class="form-label">SKU</label>
                        <input type="text" value="{{ $product->sku }}" name="sku" class="form-control" id="inputProductTitle" placeholder="Enter product title">
                      </div>
                      <div class="col-md-12">
                        <label for="inputProductTitle" class="form-label">Barcode</label>
                        <input type="text" value="{{ $product->barcode }}" name="barcode" class="form-control" id="inputProductTitle" placeholder="Enter product title">
                      </div>
                    <div class="col-md-12">
                    <label for="inputPrice" class="form-label">Price</label>
                    <input type="number" value="{{ $product->price }}" name="price" class="form-control" id="inputPrice" placeholder="00.00">
                    </div>
                    <div class="col-md-12">
                    <label for="inputCompareatprice" class="form-label">Discount Type</label>
                    <select name="discount_type" class="form-select" id="inputProductType">
                        <option {{ $product->discount_type == 'fixed'? 'selected':''  }} value="fixed">Fixed</option>
                        <option {{ $product->discount_type == 'percentage'? 'selected':''  }} value="percentage">Percentage</option>
                    </select>
                    </div>
                    <div class="col-md-12">
                    <label for="inputCostPerPrice" class="form-label">Discount</label>
                    <input name="discount" value="{{ $product->discount }}" type="number" class="form-control" id="inputCostPerPrice" placeholder="00.00">
                    </div>
                    <div class="col-md-12">
                    <label for="inputCostPerPrice" class="form-label">Tax</label>
                    <select name="tax" class="form-select" id="inputProductType">
                        @forelse ($taxes as $tax)
                         <option {{ $tax->id == $product->tax ? 'selected':''  }} value="{{  $tax->id }}">{{  $tax->tax_name }}</option>
                        @empty
                         <option disabled>First create tax</option>
                        @endforelse
                    </select>
                    </div>
                    <div class="col-md-12">
                    <label for="inputCostPerPrice" class="form-label">Quantity</label>
                    <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control" id="inputCostPerPrice" placeholder="00.00">
                    </div>
                    <div class="col-md-12">
                    <label for="inputCostPerPrice" class="form-label">Alert Quantity</label>
                    <input type="number" name="alert_quantity" value="{{ $product->alert_quantity }}" class="form-control" id="inputCostPerPrice" placeholder="00.00">
                    </div>

                </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Save Change</button>
                </div>
            </div>
            </div><!--end row-->
            </form>
        </div>
      </div>
  </div>

</div>
@endsection
@section('script_body')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function(){
        $('.delete').click(function(e){

            var form =  $(this).closest("form");
            e.preventDefault();

            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )
            }
            })
        })
    })
</script>

@if (session('status'))
<script>
 const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'success',
        title: '{{ session('status') }}'
        })
</script>
@endif
@endsection
