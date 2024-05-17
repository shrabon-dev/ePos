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
                            <th>Order#</th>
                            <th>Date</th>
                            <th>Sale By</th>
                            <th>Customer</th>
                            <th>Payment Status</th>
                            <th>Paid</th>
                            <th>Due</th>
                            <th>Grand Total</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse  ($sales as $sale)
                        {{-- @foreach ($sale as $item) --}}
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="ms-2">
                                        {{-- <h6 class="mb-0 font-14">{{ $sale[$key]->quantity }}</h6> --}}
                                        <h6 class="mb-0 font-14">#{{ $sale->id }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $sale->created_at->format('d-M-Y') }}</td>
                            <td><div class="">{{ \App\Models\User::find($sale->sale_by)->name }}</div></td>
                            <td>
                                @if ($sale->customer_id)
                                    {{ $sale->invoiceWithUser->name }}
                                @else
                                <span class="badge bg-primary">Unknown</span>
                                @endif
                            </td>
                            <td><div class="badge rounded-pill {{  $sale->payment_status == 'completed' ? 'text-success bg-light-success':'text-danger bg-light-danger' }}  p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>{{ $sale->payment_status }}</div></td>
                            <td>TK.{{ $sale->paid }}</td>
                            <td>TK.{{ $sale->due }}</td>
                            <td>TK.{{ $sale->total_price }}</td>
                            <td>
                                <div class="d-flex order-actions">
                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#exampleLargeModal{{ $sale->id }}" class=""><i class="bx bxs-edit"></i></a>
                                    <a href="{{ route('invoice.view',$sale->id) }}" class="ms-3"><i class="fadeIn animated bx bx-show-alt"></i></a>
                                    <a  href="{{ route('invoice.delete',$sale->id) }}" class="ms-3"><i class="bx bxs-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        {{-- @endforeach --}}

                        <!-- Modal -->
                        <div class="col">
                            <div class="modal fade" id="exampleLargeModal{{ $sale->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-large">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="card-title d-flex align-items-center">
                                                <div><i class="bx bxs-user me-1 font-22 text-info"></i>
                                                </div>
                                                <h5 class="mb-0 text-info">Invoice Edit</h5>
                                            </div>
                                            <form action="{{ route('invoice.update',$sale->id) }}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12">
                                                        <hr>
                                                        <div class="row mb-3">
                                                            <label for="inputEnterYourName" class="col-6">Total Price</label>
                                                            <div class="col-6">
                                                                <span>TK.</span> <input type="text" readonly name="total_price" class="inline-block fcs shadow-none" style="border: none;display:inline-block;width:70px !important" value="{{$sale->total_price}}">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="inputEnterYourName" class="col-6">Total payment</label>
                                                            <div class="col-6">
                                                                <span>TK.</span> <input type="text" readonly name="total_payment" class="inline-block fcs shadow-none" style="border: none;display:inline-block;width:70px !important" value="{{$sale->paid}}">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="inputEnterYourName" class="col-6">Total Due</label>
                                                            <div class="col-6">
                                                                <span class="text-danger">TK.</span><input type="text" readonly name="due" class="inline-block fcs text-danger shadow-none" style="border: none;display:inline-block;width:70px !important" value="{{$sale->due}}">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="inputEnterYourName" class="col-6">Now Paying</label>
                                                            <div class="col-6">
                                                                <input type="text" name="now_paying" class="inline-block fcs shadow-none" style="border: none;display:inline-block;width:70px" value=""><span>TK.</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary mt-2">Save Changes</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
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
</script>
@endif

@endsection

