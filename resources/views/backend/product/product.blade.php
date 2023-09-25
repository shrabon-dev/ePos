@extends('layouts.backendMaster')

@section('backend_content')
<div class="page-content">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-xl-2">
                            <a href="{{ route('product.create') }}" class="btn btn-primary mb-3 mb-lg-0"><i class="bx bxs-plus-square"></i>New Product</a>
                        </div>
                        <div class="col-lg-9 col-xl-10">
                            <form class="float-lg-end">
                                <div class="row row-cols-lg-2 row-cols-xl-auto g-2">
                                    <div class="col">
                                        <div class="position-relative">
                                            <input type="text" class="form-control ps-5" placeholder="Search Product..."> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                            <button type="button" class="btn btn-white">Sort By</button>
                                            <div class="btn-group" role="group">
                                              <button id="btnGroupDrop1" type="button" class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-chevron-down"></i>
                                              </button>
                                              <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                                <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                              </ul>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="col">
                                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                            <button type="button" class="btn btn-white">Collection Type</button>
                                            <div class="btn-group" role="group">
                                              <button id="btnGroupDrop1" type="button" class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bxs-category"></i>
                                              </button>
                                              <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                                <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                              </ul>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="col">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-white">Price Range</button>
                                            <div class="btn-group" role="group">
                                              <button id="btnGroupDrop1" type="button" class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-slider"></i>
                                              </button>
                                              <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="btnGroupDrop1">
                                                <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                                <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                              </ul>
                                            </div>
                                          </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">Orders Summary</h5>
                </div>
                <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>SL. No.</th>
                            <th>Product</th>
                            <th>code</th>
                            <th>barcode</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Add Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($products as $product)
                        <tr>
                            <td>#{{ $product->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="recent-product-img">
                                        <img src="{{ asset('storage/product') }}/{{ $product->image }}" alt="">
                                    </div>
                                    <div class="ms-2">
                                        <h6 class="mb-1 font-14">{{ $product->name }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->barcode }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                @if ($product->status == 'active')
                                <div class="d-flex align-items-center text-primary">	<i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
                                    <span>{{ $product->status }}</span>
                                </div>
                                @else
                                <div class="d-flex align-items-center text-danger">	<i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
                                    <span>{{ $product->status }}</span>
                                </div>
                                @endif
                            </td>
                            <td>{{ $product->created_at->format('D m, Y') }}</td>

                            <td>

                                <a href="{{ route('product.edit',$product->id) }}" style="display:inline-flex;width: 30px; height:30px; box-shadow: 0 0  3px 0 #00000045;font-size:16px; justify-content:center;align-items:center; " title="edit" ><i class="lni lni-pencil"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#exampleLargeModal{{ $product->id }}" style="display:inline-flex;width: 30px; height:30px; box-shadow: 0 0  3px 0 #00000045;font-size:16px; justify-content:center;align-items:center; color:blue" title="view" href="#"><i class="fadeIn animated bx bx-show"></i></a>

                                <form style="display: inline-block" action="{{ route('product.destroy',$product->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                     <button style="display:inline-flex;width: 30px; height:30px; box-shadow: 0 0  3px 0 #00000045;font-size:16px; justify-content:center;align-items:center; color:red;background: transparent;border:none;" title="delete"  class="delete border-none" type="submit">
                                        <i class="fadeIn animated bx bx-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                            <!-- Button trigger modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="exampleLargeModal{{ $product->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Product Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-2">
                                            <div class="pb-2" style="width: 200px">
                                                <img width="100%" style="display: block" src="{{ asset('storage/product') }}/{{ $product->image }}" alt="{{ $product->image }}">
                                            </div>
                                            <div class="card p-5">
                                                <div class="row">
                                                    <div class="col-sm-6">

                                                            <ul class="d-flex list-unstyled gap-1">
                                                                <li style="width:60px">Name : </li>
                                                                <li style="">{{ $product->name }}</li>
                                                            </ul>
                                                            <ul class="d-flex list-unstyled gap-1">
                                                                <li style="width:60px">Code : </li>
                                                                <li style="">{{ $product->code }}</li>
                                                            </ul>
                                                            <ul class="d-flex list-unstyled gap-1">
                                                                <li style="width:70px">Category : </li>
                                                                <li style="">{{ $product->category }}</li>
                                                            </ul>
                                                            <ul class="d-flex list-unstyled gap-1">
                                                                <li style="width:60px">Brand : </li>
                                                                <li style="">{{ $product->brand }}</li>
                                                            </ul>
                                                            <ul class="d-flex list-unstyled gap-1">
                                                                <li style="width:60px">Unit : </li>
                                                                <li style="">{{ $product->unit }}</li>
                                                            </ul>
                                                            <ul class="d-flex list-unstyled gap-1">
                                                                <li style="width:80px">Warehouse : </li>
                                                                <li style="">{{ $product->warehouse }}</li>
                                                            </ul>
                                                            <ul class="d-flex list-unstyled gap-1">
                                                                <li style="width:60px">Status : </li>
                                                                <li style="">{{ $product->status }}</li>
                                                            </ul>
                                                            <ul class="d-flex list-unstyled gap-1">
                                                                <li style="width:80px">Description : </li>
                                                                <li style="">{{ $product->description }}</li>
                                                            </ul>
                                                    </div>
                                                    <div class="col-sm-6">
                                                            <ul class="d-flex list-unstyled gap-1">
                                                                <li style="width:60px">SKU : </li>
                                                                <li style="">{{ $product->sku }}</li>
                                                            </ul>
                                                            <ul class="d-flex list-unstyled gap-1">
                                                                <li style="width:60px">Barcode : </li>
                                                                <li style="">{{ $product->barcode }}</li>
                                                            </ul>
                                                            <ul class="d-flex list-unstyled gap-1">
                                                                <li style="width:60px">Price : </li>
                                                                <li style="">{{ $product->price }}</li>
                                                            </ul>
                                                            <ul class="d-flex list-unstyled gap-1">
                                                                <li style="width:100px">Discount Type : </li>
                                                                <li style="">{{ $product->discount_type }}</li>
                                                            </ul>
                                                            <ul class="d-flex list-unstyled gap-1">
                                                                <li style="width:70px">Discount : </li>
                                                                <li style="">{{ $product->discount }}</li>
                                                            </ul>
                                                            <ul class="d-flex list-unstyled gap-1">
                                                                <li style="width:60px">Tax : </li>
                                                                <li style="">{{ $product->tax }}</li>
                                                            </ul>
                                                            <ul class="d-flex list-unstyled gap-1">
                                                                <li style="width:60px">Quantity : </li>
                                                                <li style="">{{ $product->quantity }}</li>
                                                            </ul>
                                                            <ul class="d-flex list-unstyled gap-1">
                                                                <li style="width:100px">Alert Quantity : </li>
                                                                <li style="">{{ $product->alert_quantity }}</li>
                                                            </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        @empty
                        <tr>
                            <td colspan="8" class="text-center bold bg-warning">!!Not product yet!!</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
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
