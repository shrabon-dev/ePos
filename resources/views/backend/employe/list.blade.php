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
                        <th>Sl.</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Entry Date</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse  ($employes as $employe)
                    {{-- @foreach ($sale as $item) --}}
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">

                                <div class="ms-2">
                                    {{-- <h6 class="mb-0 font-14">{{ $sale[$key]->quantity }}</h6> --}}
                                    <h6 class="mb-0 font-14">{{ $employe->id }}</h6>
                                </div>
                            </div>
                        </td>
                        <td>{{ $employe->name }}</td>
                        <td>{{ $employe->phone }}</td>
                        <td>{{ $employe->address }}</td>
                        <td>{{ $employe->created_at->format('d-M-Y') }}</td>
                        <td>
                            <div class="d-flex order-actions">
                                <a href="{{ route('employe.show',$employe->id) }}" class="ms-3"><i class="fadeIn animated bx bx-show-alt"></i></a>
                                {{-- <a  href="" class="ms-3"><i class="bx bxs-trash"></i></a> --}}
                                <form id="delete-post-form" class="btn-delete" action="{{ route('employe.destroy',$employe->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button style="border: none;" class="ms-3 border-none btn-sm"><i class="bx bxs-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    {{-- @endforeach --}}

                    <!-- Modal -->

                    <div class="modal fade" id="exampleLargeModal{{ $employe->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-large">
                            <div class="modal-content">
                                <div class="modal-body">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
        icon: 'danger',
        title: '{{ session('delete') }}',
        })
    </script>
@endif

    <script>
        let deleteBtn = document.querySelector('.btn-delete')
        deleteBtn.addEventListener('click', (e) => {
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
                    // If confirmed, submit the form
                    document.getElementById('delete-post-form').submit();
                }
            });
        });
    </script>

@endsection

