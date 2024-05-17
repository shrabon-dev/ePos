@extends('layouts.backendMaster')
@section('backend_content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">eCommerce</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Orders</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary">Settings</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                    <a class="dropdown-item" href="javascript:;">Another action</a>
                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                    <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
     {{-- Error Message Alert Start --}}
     @if ($errors->any())
     @foreach ($errors->all() as $error)
         <div class="alert alert-danger" role="alert">
             <strong>{{ $error }}</strong>
         </div>
     @endforeach
     @endif
{{-- Error Message Alert End --}}

    <div class="card">
        <div class="card-body">
            <div class="d-lg-flex align-items-center mb-4 gap-3">
                <div class="position-relative">
                    <input type="text" class="form-control ps-5 radius-30" placeholder="Search Order"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                </div>
              <div class="ms-auto"><a href="javascript:;" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Add New Order</a></div>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>SL No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>GST number</th>
                            <th>Tax number</th>
                            <th>Country</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Post Code</th>
                            <th>Address</th>
                            <th>Create Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse  ($suppliers as $supplier)
                        {{-- @foreach ($sale as $item) --}}
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6 class="mb-0 font-14">#{{ $supplier->id }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td><div>{{ $supplier->name}}</div></td>
                            <td><div>{{ $supplier->email}}</div></td>
                            <td><div>{{ $supplier->phone_number}}</div></td>
                            <td>{{ $supplier->gst_number}}</td>
                            <td>{{ $supplier->tax_number}}</td>
                            <td>{{ $supplier->country}}</td>
                            <td><div>{{ $supplier->city}}</div></td>
                            <td>{{ $supplier->state}}</td>
                            <td>{{ $supplier->post_code}}</td>
                            <td>{{ $supplier->address}}</td>
                            <td>{{ $supplier->created_at->format('d-M-Y') }}</td>
                            <td>
                                <div class="d-flex order-actions">
                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#exampleLargeModal{{ $supplier->id }}" class=""  style="display:inline-flex;width: 30px; height:30px; box-shadow: 0 0  3px 0 #00000045;font-size:16px; justify-content:center;align-items:center; color:blue;background: transparent;border:none;"><i class="bx bxs-edit"></i></a>
                                    <form action="{{ route('supplier.destroy',$supplier->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class=""  style="display:inline-flex;width: 30px; height:30px; box-shadow: 0 0  3px 0 #00000045;font-size:16px; justify-content:center;align-items:center; color:red;background: transparent;border:none;"><i class="bx bxs-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        {{-- @endforeach --}}
                        <!-- Modal -->
                        <div class="modal fade" id="exampleLargeModal{{ $supplier->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">supplier Update</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body p-4">
                                        <form action="{{ route('supplier.update',$supplier->id) }}" id="formSubmit" method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                                <div class="row mb-3">
                                                    <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" name="name" value="{{ $supplier->name }}" class="form-control" id="inputPhoneNo2" placeholder="name">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Email</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" name="email" value="{{ $supplier->email }}" class="form-control" id="inputPhoneNo2" placeholder="email">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Phone Number</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" name="phone_number" value="{{ $supplier->phone_number }}" class="form-control" id="inputPhoneNo2" placeholder="number">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputPhoneNo2" class="col-sm-3 col-form-label">GST Number</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" name="gst_number" value="{{ $supplier->gst_number }}" class="form-control" id="inputEnterYourName" placeholder="gst number">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Tax Number</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" name="tax_number" value="{{ $supplier->tax_number }}" class="form-control" id="inputEnterYourName" placeholder="tax number">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Country</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="country" value="{{ $supplier->country }}" class="form-control" id="inputEmailAddress2" placeholder="country">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputEmailAddress2" class="col-sm-3 col-form-label">City</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="city" value="{{ $supplier->city }}" class="form-control" id="inputEmailAddress2" placeholder="city">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputEmailAddress2" class="col-sm-3 col-form-label">State</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="state" value="{{ $supplier->state }}" class="form-control" id="inputEmailAddress2" placeholder="state">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Post Code</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="post_code" value="{{ $supplier->post_code }}" class="form-control" id="inputEmailAddress2" placeholder="code">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Address</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="address" value="{{ $supplier->address }}" class="form-control" id="inputEmailAddress2" placeholder="address">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-9">
                                                        <button type="submit" class="btn btn-info px-5 text-light text-bold">Update</button>
                                                    </div>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-danger">
                                    No Sales yet!!
                                </td>
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
@if (session('updated'))
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
    title: '{{ session('updated') }}',
    })
</script>
@endif
@if (session('delete'))
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
    title: '{{ session('delete') }}',
    })


    document.addEventListener('DOMContentLoaded', function () {
            var form = document.getElementById('formSubmit');

            form.addEventListener('submit', function (event) {
                event.preventDefault();
                console.log('Form submission prevented. Add your custom logic here.');
            });
        });

</script>

@endif

@endsection

