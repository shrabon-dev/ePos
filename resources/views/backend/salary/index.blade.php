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
                            <th>SL No.</th>
                            <th>Employee</th>
                            <th>Disegnation</th>
                            <th>Amount</th>
                            <th>Pay</th>
                            <th>Due</th>
                            <th>Status</th>
                            <th>Note</th>
                            <th>Issue date</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse  ($salaries as $salary)
                        {{-- @foreach ($sale as $item) --}}
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="ms-2">
                                        {{-- <h6 class="mb-0 font-14">{{ $sale[$key]->quantity }}</h6> --}}
                                        <h6 class="mb-0 font-14">#{{ $salary->id }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $salary->relationWithEmployee->name }}</td>
                            <td><div class="">{{ $salary->designation }}</div></td>
                            <td><div class="">{{ $salary->amount }}</div></td>
                            <td><div class="">{{ $salary->pay }}</div></td>

                            {{-- <td><div class="badge rounded-pill {{  $sale->payment_status == 'completed' ? 'text-success bg-light-success':'text-danger bg-light-danger' }}  p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>{{ $salary->payment_status }}</div></td> --}}
                            <td>TK.{{ $salary->due }}</td>
                            <td>{{ $salary->status }}</td>
                            <td>{{ $salary->note }}</td>
                            <td>{{ $salary->created_at->format('d-M-Y') }}</td>
                            <td>
                                <div class="d-flex order-actions">
                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#exampleLargeModal{{ $salary->id }}" class=""  style="display:inline-flex;width: 30px; height:30px; box-shadow: 0 0  3px 0 #00000045;font-size:16px; justify-content:center;align-items:center; color:blue;background: transparent;border:none;"><i class="bx bxs-edit"></i></a>
                                    <form action="{{ route('salary.destroy',$salary->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class=""  style="display:inline-flex;width: 30px; height:30px; box-shadow: 0 0  3px 0 #00000045;font-size:16px; justify-content:center;align-items:center; color:red;background: transparent;border:none;"><i class="bx bxs-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        {{-- @endforeach --}}
                        <!-- Modal -->
                        <div class="modal fade" id="exampleLargeModal{{ $salary->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Salary Update</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <form action="{{ route('salary.update',$salary->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                                <div class="row mb-3">
                                                    <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Designation</label>
                                                    <div class="col-sm-9">
                                                        <select name="designation" id="" class="form-control">
                                                            <option value="" disabled selected>Select job type...</option>
                                                            @foreach ($roles as $role)
                                                                <option value="{{ $role->name }}"  @if ($role->name == $salary->designation) selected @endif>{{ $role->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputEnterYourName" class="col-sm-3 col-form-label">Employe</label>
                                                    <div class="col-sm-9">
                                                        <select name="employee_id" id="" class="form-control">
                                                            <option value="" disabled selected>Select Employee...</option>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id }}" @if ($user->id == $salary->employee_id) selected @endif>{{ $user->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Salary Amount</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" name="amount" class="form-control" value="{{ $salary->amount }}" id="inputPhoneNo2" placeholder="Salary Amount">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Pay</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" name="pay" class="form-control" value="{{ $salary->pay }}" id="inputEnterYourName" placeholder="Paying">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Due</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" name="due" class="form-control" value="{{ $salary->due }}" id="inputEnterYourName" placeholder="Due">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Note</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="note" class="form-control" value="{{ $salary->note }}" id="inputEmailAddress2" placeholder="Note...">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label"></label>
                                                    <div class="col-sm-9">
                                                        <button type="submit" class="btn btn-info px-5 text-light text-bold">Pay</button>
                                                    </div>
                                                </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info text-light " data-bs-dismiss="modal">Update</button>
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

