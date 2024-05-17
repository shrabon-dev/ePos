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
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="row">
               <div class="col-lg-6">
               <div class="border border-3 p-4 rounded">
                  <div class="mb-3">
                    <label for="inputProductTitle" class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" id="inputProductTitle" placeholder="Enter product title">
                  </div>
                  <div class="mb-3">
                    <label for="inputProductTitle" class="form-label">Product Code</label>
                    <input type="text" name="code" class="form-control" id="inputProductTitle" placeholder="Enter product title">
                  </div>
                  <div class="mb-3">
                    <label for="inputProductType" class="form-label">Category</label>
                    <select name="category" class="form-select" id="inputProductType">
                        <option value="" disabled selected>Choose a category</option>
                        @foreach ($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="mb-3">
                    <label for="inputProductType" class="form-label">Supplier</label>
                    <select name="category" class="form-select" id="inputProductType">
                        <option value="" disabled selected>Choose a supplier</option>
                        @foreach ($suppliers as $supplier)
                          <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="mb-3">
                    <label for="inputProductType" class="form-label">Brand</label>
                    <select name="brand" class="form-select" id="inputProductType">
                            <option value="" disabled selected>Choose a brand</option>
                        @foreach ($brands as $brand)
                          <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                      </select>
                  </div>
                    <div class="mb-3">
                        <label for="inputProductType" class="form-label">Warehouse</label>
                        <select name="warehouse" class="form-select" id="inputProductType">
                            <option value="Sherpur-Tawon">Sherpur-Tawon</option>
                            <option value="Sherpur - Kharom Pur">Sherpur - Kharom Pur</option>
                        </select>
                    </div>
                  <div class="mb-3">
                    <label for="inputProductType" class="form-label">Status</label>
                    <select name="status" class="form-select" id="inputProductType">
                        <option value="active">Active</option>
                        <option value="deactive">Deactive</option>
                    </select>
                  </div>


                  <div class="mb-3">
                    <label for="inputProductDescription" class="form-label">Description</label>
                    <textarea name="description" class="form-control" id="inputProductDescription" rows="3"></textarea>
                  </div>
                  <div class="">
                    <label for="inputProductDescription" class="form-label">Product Images</label>
                    <input name="image" type="file"  >
                </div>
                </div>
               </div>
               <div class="col-lg-6">
                <div class="border border-3 p-4 rounded">
                  <div class="row g-3">
                    <div class="col-md-12">
                        <label for="inputProductType" class="form-label">Unit</label>
                        <select name="unit" class="form-select" id="inputProductType">
                            <option value="pc">PC</option>
                            <option value="kg">KG</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="inputProductTitle" class="form-label">SKU</label>
                        <input type="text" name="sku" class="form-control" id="inputProductTitle" placeholder="Enter product title">
                      </div>
                      <div class="col-md-12">
                        <label for="inputProductTitle" class="form-label">Barcode</label>
                        <input type="text" name="barcode" class="form-control" id="inputProductTitle" placeholder="Enter product title">
                      </div>
                    <div class="col-md-12">
                    <label for="inputPrice" class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" id="inputPrice" placeholder="00.00">
                    </div>
                    <div class="col-md-12">
                    <label for="inputCompareatprice" class="form-label">Discount Type</label>
                    <select name="discount_type" class="form-select" id="inputProductType">
                        <option value="fixed">Fixed</option>
                        <option value="percentage">Percentage</option>
                    </select>
                    </div>
                    <div class="col-md-12">
                    <label for="inputCostPerPrice" class="form-label">Discount</label>
                    <input name="discount" type="number" class="form-control" id="inputCostPerPrice" placeholder="00.00">
                    </div>
                    <div class="col-md-12">
                    <label for="inputCostPerPrice" class="form-label">Tax</label>
                    <select name="tax" class="form-select" id="inputProductType">
                        @forelse ($taxes as $tax)
                         <option value="{{  $tax->id }}">{{  $tax->tax_name }}</option>
                        @empty
                         <option disabled>First create tax</option>
                        @endforelse
                    </select>
                    </div>
                    <div class="col-md-12">
                    <label for="inputCostPerPrice" class="form-label">Quantity</label>
                    <input type="number" name="quantity" class="form-control" id="inputCostPerPrice" placeholder="00.00">
                    </div>
                    <div class="col-md-12">
                    <label for="inputCostPerPrice" class="form-label">Alert Quantity</label>
                    <input type="number" name="alert_quantity" class="form-control" id="inputCostPerPrice" placeholder="00.00">
                    </div>

                </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Save Product</button>
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
